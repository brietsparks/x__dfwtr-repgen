<?php namespace App\Spinner\Model\NounPhrases;

use App\Spinner\Model\NounPhrase;
use App\Spinner\Model\Words\Nouns\House;
use App\Spinner\Model\Words\Nouns\Housing;


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