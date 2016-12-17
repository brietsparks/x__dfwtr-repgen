<?php namespace SpinnerBundle\Spinner\Model\NounPhrases;

use SpinnerBundle\Spinner\Model\NounPhrase;
use SpinnerBundle\Spinner\Model\Words\Nouns\House;
use SpinnerBundle\Spinner\Model\Words\Nouns\Housing;


class Inventory extends NounPhrase {

	public function spin() {
		$houses = House::plural();
		$housing = Housing::singular();

		$phrases = array(
			"$houses for sale <%{on|in} the market%>"
		);

		return $this->spinner->spinArray($phrases);
	}

}