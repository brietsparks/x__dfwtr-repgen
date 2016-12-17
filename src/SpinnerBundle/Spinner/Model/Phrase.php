<?php namespace SpinnerBundle\Spinner\Model;

use SpinnerBundle\Spinner\Spinner;

class Phrase implements Spinnable{
	/**
	 * @var Spinner
	 */
	protected $spinner;

	public function __construct() {
		$this->spinner = new Spinner();
	}

	public static function make() {
		return new static;
	}

	public static function phrase() {
		$phrase = new static;
		return $phrase->spin();
	}

	public function spin() {

	}

}