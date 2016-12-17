<?php namespace App\Spinner\Model\Words;

use App\Spinner\Model\Word;
use App\Spinner\Inflect;

class Noun extends Word {

	/**
	 * @var Inflect
	 */
	protected $inflect;

	/**
	 * Noun constructor.
	 */
	public function __construct() {
		$this->inflect = new Inflect();
		parent::__construct();
	}


	/**
	 * @return string
	 */
	public function toSingular() {
		return $this->inflect->singularize($this->spin());
	}

	/**
	 * @return string
	 */
	public function toPlural() {
		return $this->inflect->pluralize($this->spin());
	}

	/**
	 * @return mixed
	 */
	public static function singular() {
		$word = new static;
		return $word->toSingular();
	}

	/**
	 * @return mixed
	 */
	public static function plural() {
		$word = new static;
		return $word->toPlural();
	}
}