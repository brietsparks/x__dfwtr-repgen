<?php namespace App\Spinner\Model\Phrases;

class PercentDecrease extends PercentDifference {
	protected $nouns = array(
		'decrease',
		'dip',
		'fall',
		'slump',
		'down-slide',
		'drop',
		'decline'
	);

	protected $verbs = array(
		'decreased',
		'dipped',
		'slid',
		'fell',
		'sunk',
		'slumped',
		'went down',
		'was lower',
		'dropped',
		'lost',
		'declined',
		'was less',
		'dwindled',
		'subsided'
	);

	protected $adjectives = array(
		'down',
		'lower'
	);


	/**
	 * @return number
	 */
	public function value() {
		return $this->absValue();
	}
}