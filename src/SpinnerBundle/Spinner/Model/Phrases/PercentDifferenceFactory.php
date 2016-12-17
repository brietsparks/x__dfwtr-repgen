<?php namespace SpinnerBundle\Spinner\Model\Phrases;

use SpinnerBundle\Spinner\Model\Phrases\PercentDifference;
use SpinnerBundle\Spinner\Model\Phrases\PercentDecrease;
use SpinnerBundle\Spinner\Model\Phrases\PercentIncrease;
use SpinnerBundle\Spinner\Model\Phrases\PercentHold;

class PercentDifferenceFactory {

	/**
	 * @var number
	 */
	protected $value;

	/**
	 * @param number $value
	 */
	public function __construct($value) {
		$value = is_null($value) ? 0 : $value;
		$this->value = $value;
	}

	/**
	 * @param number $value
	 * @return static
	 */
	public static function make($value) {
		return new static($value);
	}

	/**
	 * @return PercentDifference
	 * @throws \Exception
	 */
	public function get() {
		$value = $this->value;
		$result = null;
		if($value > 0) {
			$result = PercentIncrease::make()->setValue($value);
		} elseif($value < 0) {
			$result = PercentDecrease::make()->setValue($value);
		} elseif($value == 0) {
			$result = PercentHold::make()->setValue($value);
		}

		return $result;
	}




}