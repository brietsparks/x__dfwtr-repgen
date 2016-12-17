<?php namespace App\Models;


use App\Spinner\Inflect;
use App\Spinner\Spinner;

use App\Spinner\Model\Words\Nouns\House;
use App\Spinner\Model\Phrases\PercentDifferenceFactory as Difference;
use App\Spinner\Model\Passages\SalesReported;
use App\Spinner\Model\Passages\SalesProjected;
use App\Spinner\Model\Passages\NewListings;
use App\Spinner\Model\Passages\ContractListings;
use App\Spinner\Model\Passages\MonthsSupply;
use App\Spinner\Model\Passages\Inventory;
use App\Spinner\Model\Passages\PercentReceived;
use App\Spinner\Model\Passages\DaysOnMarket;

use App\Spinner\Model\Passages\AveragePrice;

use App\Cleaner\Cleaner;

class Article {

	/**
	 * @var Spinner
	 */
	protected $spinner;

	/**
	 * @var City
	 */
	protected $city;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $body;

	/**
	 * @var string
	 */
	protected $footer;

	/**
	 * @param City $city
	 */
	public function __construct(City $city) {
		$this->city = $city;
		$this->spinner = new Spinner();
	}

	/**
	 * @param City $city
	 * @return static
	 */
	public static function make(City $city) {
		return new static($city);
	}



	public function generate() {

		$article = '';

		$article .= $this->title();
			$article .= "\r\n";
		$article .= $this->city->fullTableOutput();
			$article .= "\r\n";
		$article .= $this->body();
			$article .= "\r\n";
		$article .= $this->footer();
			$article .= "\r\n\r\n";

		return $article;
	}


	/**
	 * @return string
	 */
	protected function title() {
		$city = $this->city;
		$report = SalesReported::make()->setCity($city)->setCompare();
		$difference = Difference::make($report->monthChange())->get();
		$month = $report->city->getMonthReport()->getCurrentYear()->month;
		$year = $report->city->getMonthReport()->getCurrentYear()->year;
		$title = "{$report->city->name} <%residential %>{housing|home|property} sales for $month $year <%are %>{$difference->adjPhrase()}";
		$title = "TITLE: " . ucwords($this->spinner->spinString($title));
		$this->title = $title;
		return $title;
	}

	protected function table() {
		return $this->city->fullTableOutput();
	}

	/**
	 * @return string
	 */
	protected function body() {
		$city = $this->city;
		$passage = array(
			'<p>',
			SalesReported::make()->setCity($city)->setCompare()->fullPassage(),
			SalesProjected::make()->setCity($city)->fullPassage(),
			NewListings::make()->setCity($city)->fullPassage(),
			ContractListings::make()->setCity($city)->setCompare()->fullPassage(),
			MonthsSupply::make()->setCity($city)->monthPassage(),
			Inventory::make()->setCity($city)->monthPassage(),
			DaysOnMarket::make()->setCity($city)->setCompare()->monthPassage(),
			PercentReceived::make()->setCity($city)->fullPassage(),
			'</p>'
		);
		$body = concatenate($passage);
		$this->body = $body;
		return $body;
	}

	/**
	 * @return string
	 */
	public function footer() {
	 	return $this->footer;
	}

	/**
	 * @param string $footer
	 * @return $this
	 */
	public function setFooter($footer) {
		$this->footer = $footer;
		return $this;
	}


	public function test() {
		$a = 'DFW Team Realty is your local expert specializing in home sales in the Colony subdivision, as well as home foreclosures and short sales in the Colony subdivision. ';
		$b = "If you are looking to buy or sell a home in Colony, contact DFW Team Realty or <a rel='nofollow' href='http://www.dfwhomevaluesreport.com/idx/register.html'>visit us online</a> to receive updates on home values in your city and neighborhood.";
	}




}