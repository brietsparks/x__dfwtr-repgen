<?php namespace SpinnerBundle\Spinner\Model;

use SpinnerBundle\Spinner\Spinner;
use SpinnerBundle\Spinner\Inflect;

class Sentence {

	/**
	 * @var Spinner
	 */
	protected $spinner;

	/**
	 * @var Inflect
	 */
	protected $inflect;

	/**
	 * Sentence constructor.
	 */
	public function __construct() {
		$this->spinner = new Spinner;
		$this->inflect = new Inflect;
	}



}