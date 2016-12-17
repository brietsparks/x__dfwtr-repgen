<?php namespace SpinnerBundle\Spinner\Model\NounPhrases;

useSpinnerBundle\Spinner\Model\NounPhrase;
useSpinnerBundle\Spinner\Model\Words\Nouns\House;

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