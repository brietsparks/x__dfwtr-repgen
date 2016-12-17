<?php namespace SpinnerBundle\Scraper;
use SpinnerBundle\Models\CityMeta;
use Smalot\PdfParser\Document;
use Smalot\PdfParser\Parser;
use SpinnerBundle\Models\City;

class PdfScraper {

	protected $parser;
	protected $path;

	/**
	 * @param string $path
	 */
	public function __construct($path) {
		$this->path = $path;
		$this->parser = new Parser();
	}

	/**
	 * @param $path
	 * @return static
	 */
	public static function make($path) {
		return new static($path);
	}

	/**
	 * @return array
	 */
	public function extract() {
		$pdf = $this->parser->parseFile($this->path);
		$this->check($pdf);
		$text = $pdf->getText();
		$rows = explode("\n", $text);

		$rows = $this->fixRows($rows);


        $extracted = array(
            'year'             => $rows[1],
            'newListings'      => $rows[3],
            'salesReported'    => $rows[4],
            'salesProjected'   => $rows[5],
            'contractListings' => $rows[6],
            'averagePrice'     => $rows[7],
            'medianPrice'      => $rows[8],
            'percentReceived'  => $rows[9],
            'daysOnMarket'     => $rows[10],
            'inventory'        => $rows[11],
            'monthsSupply'     => $rows[12]
        );

		$cityName = $rows[17];
		$month = explode(" ",$rows[13]);
		$month = $month[0];

		foreach ($extracted as $key => $arr) {
			 $extracted[$key] = $this->cleanRow($arr);
		}

		foreach($extracted as $key => $arr) {
			$extracted[$key] = explode(" ", $arr);
		}

		foreach($extracted as $key => $arr) {
			$extracted[$key]  = array_values(array_filter($arr, function($val) {
				return is_numeric($val);
			}));
		}

		$city = new City;

//		dd($extracted);

		$city->getMonthReport()->getPreviousYear()->month = $month;
		$city->getMonthReport()->getCurrentYear()->month = $month;
		$city->getYtdReport()->getPreviousYear()->month = $month;
		$city->getYtdReport()->getCurrentYear()->month = $month;

		$city->getMonthReport()->getPreviousYear()->year = $extracted['year'][0];
		$city->getMonthReport()->getCurrentYear()->year = $extracted['year'][1];
		$city->getYtdReport()->getPreviousYear()->year = $extracted['year'][0];
		$city->getYtdReport()->getCurrentYear()->year = $extracted['year'][1];
		unset($extracted['year']);

		$city->getMonthReport()->getPreviousYear()->inventory = $extracted['inventory'][0];
		$city->getMonthReport()->getCurrentYear()->inventory = $extracted['inventory'][1];
		$city->getMonthReport()->getChange()->inventory = $extracted['inventory'][2];
		unset($extracted['inventory']);

		$city->getMonthReport()->getPreviousYear()->monthsSupply = $extracted['monthsSupply'][0];
		$city->getMonthReport()->getCurrentYear()->monthsSupply = $extracted['monthsSupply'][1];
		$city->getMonthReport()->getChange()->monthsSupply = $extracted['monthsSupply'][2];
		unset($extracted['monthsSupply']);

		foreach ($extracted as $key => $arr) {
			if(array_key_exists(0,$arr)) $city->getMonthReport()->getPreviousYear()->$key = $arr[0];
			if(array_key_exists(1,$arr)) $city->getMonthReport()->getCurrentYear()->$key = $arr[1];
			if(array_key_exists(2,$arr)) $city->getMonthReport()->getChange()->$key = $arr[2];
			if(array_key_exists(3,$arr)) $city->getYtdReport()->getPreviousYear()->$key = $arr[3];
			if(array_key_exists(4,$arr)) $city->getYtdReport()->getCurrentYear()->$key = $arr[4];
			if(array_key_exists(5,$arr)) $city->getYtdReport()->getChange()->$key = $arr[5];
		}

		$city->getYtdReport()->getCurrentYear()->formatFields();
		$city->getYtdReport()->getPreviousYear()->formatFields();
		$city->getMonthReport()->getCurrentYear()->formatFields();
		$city->getMonthReport()->getPreviousYear()->formatFields();

		$city->name = $cityName;
//		dd($cityName);
		$meta = CityMeta::make($city);

		$city->mls = $meta->mls();
		if($meta->hasAlias()) {
			$cities = array();
			foreach($meta->aliases() as $alias) {
				$newCity = clone $city;
				$newCity->name = $alias;
				$cities[] = $newCity;
			}
			return $cities;
		} else {
			return array($city);
		}
	}

	protected function cleanRow($row) {
		$row = preg_replace('([a-zA-Z])','',$row);
		$row = str_replace('*','',$row);
		$row = str_replace('%','% ',$row);
		$row = str_replace('%','',$row);
		$row = str_replace(',','',$row);
		$row = str_replace('(','',$row);
		$row = str_replace(')','',$row);
		$row = str_replace('$',' $',$row);
		$row = str_replace('$','',$row);
		$row = str_replace('+ ',' +',$row);
		$row = str_replace('+','',$row);
		$row = str_replace('- ',' -',$row);

		return $row;
	}


	protected function check($pdf) {
		$text = $pdf->getText();
		$rows = explode("\n", $text);
		if($rows[0] !== "Where Our Members Live and Work") {
			dd("Error parsing file " . basename($this->path));
		}
	}

	protected function fixRows($rows) {
		if(!strpos($rows[10],'Market') > 0) {
			for($i = 10; !strpos($rows[$i],'Market'); $i++) {
				$rows[9] .= $rows[$i];
				unset($rows[$i]);
			}
		}
		return $rows;
	}






}