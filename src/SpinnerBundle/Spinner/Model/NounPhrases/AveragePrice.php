<?php namespace SpinnerBundle\Spinner\Model\NounPhrases;

use SpinnerBundle\Spinner\Model\NounPhrase;
use SpinnerBundle\Spinner\Model\Words\Nouns\House;
use SpinnerBundle\Spinner\Model\Words\Nouns\Housing;

class AveragePrice extends NounPhrase {

	public function spin() {
		$house = House::singular();
		$housing = Housing::singular();

		$phrases = array(
			"the price of a $house",
			"$housing prices"
		);

		return $this->spinner->spinArray($phrases);
	}

}