<?php namespace App\Spinner\Model;

use App\Spinner\Spinner;
use App\Spinner\Inflect;

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