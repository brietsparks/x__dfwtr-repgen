<?php namespace App\Models;


class City {

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $mls;

	/**
	 * @var Report
	 */
	protected $monthReport;

	/**
	 * @var Report
	 */
	protected $ytdReport;


	public function __construct() {
		$this->monthReport = new Report;
		$this->ytdReport = new Report;
	}


	/**
	 * @return Report
	 */
	public function getMonthReport() {
		return $this->monthReport;
	}

	/**
	 * @return Report
	 */
	public function getYtdReport() {
		return $this->ytdReport;
	}

	public function teaserTableOutput() {
		return $this->fullTableOutput();
	}

	public function fullTableOutput() {
		$month = $this->getMonthReport()->getCurrentYear()->month;
		$currYear = $this->getMonthReport()->getCurrentYear()->year;
		$prevYear = $this->getMonthReport()->getPreviousYear()->year;
		$tableBody = "";
		$fields = array(
			'salesReported' => "Closed Sales (Reported)",
			'salesProjected' => "Closed Sales (Projected)",
			'contractListings' => "Listings Under Contract",
			'averagePrice' => "Average Sales Price",
			'medianPrice' => "Median Sales Price",
			'percentReceived' => "Percent of Original Price Received",
			'daysOnMarket' => "Days on Market Until Sale",
			'inventory' => "Inventory of Homes for Sale",
		   	'monthsSupply' => "Months Supply of Inventory",
		);
		foreach($fields as $field => $rowHeader) {
			$tableBody .=
"<tr>
	<th align='left'>$rowHeader</th>
	<td style='min-width: 70px'>{$this->getMonthReport()->getPreviousYear()->$field}</td>
	<td style='min-width: 70px'>{$this->getMonthReport()->getCurrentYear()->$field}</td>
	<td style='min-width: 70px'>{$this->getMonthReport()->getChange()->$field}</td>
	<td style='min-width: 70px'>{$this->getYtdReport()->getPreviousYear()->$field}</td>
	<td style='min-width: 70px'>{$this->getYtdReport()->getCurrentYear()->$field}</td>
	<td style='min-width: 70px'>{$this->getYtdReport()->getChange()->$field}</td>
</tr>";
		}

		$mls = $this->mls ? "(MLS Area {$this->mls})" : '';

		return "
<table border='1' style='border-collapse: collapse;'>
<caption>{$month} {$currYear} Real Estate Market Summary for {$this->name}, TX $mls</caption>
<tr>
<th></th>
<th colspan='3'>Month</th>
<th colspan='3'>Year to Date</th>
</tr>
<tr>
<th></th>
<th>$currYear</th>
<th>$prevYear</th>
<th>% Change</th>
<th>$currYear</th>
<th>$prevYear</th>
<th>% Change</th>
</tr>
" . $tableBody . "</table>";
	}
}

