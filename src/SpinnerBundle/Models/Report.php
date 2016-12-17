<?php namespace SpinnerBundle\Models;

class Report {
	/**
	 * @var MonthlyStatistics
	 */
	protected $previousYear;

	/**
	 * @var MonthlyStatistics
	 */
	protected $currentYear;

	/**
	 * @var MonthlyStatistics
	 */
	protected $change;


	public function __construct() {
		$this->previousYear = new MonthlyStatistics();
		$this->currentYear = new MonthlyStatistics();
		$this->change = new MonthlyStatistics();
	}

	/**
	 * @return MonthlyStatistics
	 */
	public function getPreviousYear() {
		return $this->previousYear;
	}

	/**
	 * @return MonthlyStatistics
	 */
	public function getCurrentYear() {
		return $this->currentYear;
	}

	/**
	 * @return MonthlyStatistics
	 */
	public function getChange() {
		return $this->change;
	}

}
