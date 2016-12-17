<?php namespace SpinnerBundle\Spinner\Model\NounPhrases;

use SpinnerBundle\Spinner\Model\NounPhrase;
use SpinnerBundle\Spinner\Model\Words\Nouns\House;

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