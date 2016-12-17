<?php namespace App\Spinner\Model\Phrases;

class PercentIncrease extends PercentDifference {

	protected $nouns = array(
		'increase',
		'rise',
		'climb',
		'gain',
		'growth',
		'uptick',
		'hike',
		'improvement'
	);

	protected $verbs = array(
		'increased',
		'rose',
		'climbed',
		'gained',
		'grew',
		'went up',
		'was up',
		'was higher',
		'improved'
	);

	protected $adjectives = array (
		'up',
		'higher'
	);

	/**
	 * @return number
	 */
	public function value() {
		return $this->absValue();
	}
}