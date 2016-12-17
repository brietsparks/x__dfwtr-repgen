<?php namespace SpinnerBundle\Spinner\Model\NounPhrases;

use SpinnerBundle\Spinner\Model\NounPhrase;
use SpinnerBundle\Spinner\Model\Words\Nouns\House;
use SpinnerBundle\Spinner\Model\Words\Nouns\Housing;


class SalesProjected extends NounPhrase {

	public function spin() {
		$houses = House::plural();
		$housing = Housing::singular();

		$phrases = array(
			"projected $housing sales",
			"projected $houses sold"
		);

		return $this->spinner->spinArray($phrases);
	}

}