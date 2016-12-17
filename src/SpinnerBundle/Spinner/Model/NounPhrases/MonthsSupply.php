<?php namespace SpinnerBundle\Spinner\Model\NounPhrases;

use SpinnerBundle\Spinner\Model\NounPhrase;
use SpinnerBundle\Spinner\Model\Words\Nouns\House;
use SpinnerBundle\Spinner\Model\Words\Nouns\Housing;

class MonthsSupply extends NounPhrase {

	public function spin() {
		$houses = House::plural();
		$housing = Housing::singular();

		$phrases = array(
			"<%approximate%> months supply of {<%$housing%> inventory| $houses on the market}",
		);

		return $this->spinner->spinArray($phrases);
	}

}