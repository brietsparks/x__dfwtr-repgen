<?php namespace SpinnerBundle\Spinner\Model;

use SpinnerBundle\Spinner\Spinner;
use SpinnerBundle\Spinner\Inflect;

class Passage {
	/**
	 * @var Spinner
	 */
	protected $spinner;

	/**
	 * @var Inflect
	 */
	protected $inflect;

	public function __construct() {
		$this->spinner = new Spinner();
		$this->inflect = new Inflect();
	}

	/**
	 * @return static
	 */
	public static function make() {
		return new static;
	}



}