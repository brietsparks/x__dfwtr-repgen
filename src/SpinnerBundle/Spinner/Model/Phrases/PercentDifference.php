<?php namespace SpinnerBundle\Spinner\Model\Phrases;

use SpinnerBundle\Spinner\Model\Phrase;

class PercentDifference extends Phrase {

	protected $nouns = array(
		'change',
		'difference',
	);

	protected $verbs = array(
		'changed'
	);

	protected $adjectives = array();

	/**
	 * @var int
	 */
	protected $value;


	public function setValue($value) {
		$value = is_null($value) ? floatval(0) : $value;
		$this->value = $value;
		return $this;
	}

	/**
	 * @return string
	 */
	public function nounPhrase() {
		$noun = $this->spinner->spinArray($this->getNouns());
		return " a $noun of {$this->value()}%";
	}

	/**
	 * @return string
	 */
	public function verbPhrase() {
		$verb = $this->spinner->spinArray($this->getVerbs());
		return "$verb {$this->value()}%";
	}


	public function adjPhrase() {
		$adj = $this->spinner->spinArray($this->getAdjectives());
		return "$adj {$this->value()}%";
	}

	/**
	 * @return number
	 */
	public function value() {
		return $this->getValue();
	}

	/**
	 * @return array
	 */
	public function getNouns() {
		return $this->nouns;
	}

	/**
	 * @return array
	 */
	public function getVerbs() {
		return $this->verbs;
	}

	/**
	 * @return array
	 */
	public function getAdjectives() {
		return $this->adjectives;
	}

	/**
	 * @return int
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return number
	 */
	public function absValue() {
		return abs($this->getValue());
	}



}