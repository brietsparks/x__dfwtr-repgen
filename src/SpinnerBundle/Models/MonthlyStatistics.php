<?php namespace SpinnerBundle\Models;

class MonthlyStatistics {
	public $month;
	public $year;
	public $newListings;
	public $salesReported;
	public $salesProjected;
	public $contractListings;
	public $averagePrice;
	public $medianPrice;
	public $percentReceived;
	public $daysOnMarket;
	public $inventory;
	public $monthsSupply;

	public function toArray() {
		$array = [];
		foreach(get_object_vars($this) as $var => $value) {
			$array[$var] = $value;
		}
		return $array;
	}

	/**
	 * @return $this
	 */
	public function formatFields() {
		setlocale(LC_MONETARY, 'en_US');
		$this->averagePrice = $this->asDollars($this->averagePrice);
		$this->medianPrice = $this->asDollars($this->medianPrice);
		return $this;
	}

	function asDollars($value) {
		return '$' . number_format($value, 0);
	}
}