<?php namespace App\Spinner\Model\NounPhrases;

use App\Spinner\Model\NounPhrase;
use App\Spinner\Model\Words\Nouns\House;

class ContractListings extends NounPhrase {

	public function spin() {
		$houses = House::plural();

		$phrases = array(
			"listings under contract",
			"contract listings",
			"$houses listed under contract"
		);

		return $this->spinner->spinArray($phrases);
	}

}