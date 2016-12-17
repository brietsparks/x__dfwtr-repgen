<?php namespace App\Spinner\Model;

use App\Spinner\Spinner;
use App\Spinner\Inflect;

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