<?php namespace App\Spinner\Model\NounPhrases;

use App\Spinner\Model\NounPhrase;
use App\Spinner\Model\Words\Nouns\House;
use App\Spinner\Model\Words\Nouns\Housing;

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