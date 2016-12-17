<?php namespace App\Spinner\Model\NounPhrases;

use App\Spinner\Model\NounPhrase;
use App\Spinner\Model\Words\Nouns\House;
use App\Spinner\Model\Words\Nouns\Housing;


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