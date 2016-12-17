<?php namespace App\Spinner\Model\Phrases;

class PercentHold extends PercentDifference {

	protected $remained = array(
		'remained',
		'stayed',
		'were'
	);

	protected $unchanged = array(
		'steady',
		'unchanged',
		'stagnant',
		'constant',
		'unaffected',
		'flat'
	);

	protected $nouns = array(
		'no change',
		'no difference'
	);

	protected $adjectives = array(
		'up'
	);

	public function nounPhrase() {
		$noun = $this->spinner->spinArray($this->getNouns());
		return $noun;
	}

	public function verbPhrase() {
		return $this->spinner->spinArray($this->remained) . " " .
								$this->spinner->spinArray($this->unchanged);
	}

}