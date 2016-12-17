<?php namespace App\Spinner\Model\NounPhrases;

use App\Spinner\Model\NounPhrase;
use App\Spinner\Model\Words\Nouns\House;

class NewListings extends NounPhrase {

	public function spin() {
		$house = House::singular();
		$houses = House::plural();

		$phrases = array(
			"new <%$house%> listings",
			"new $houses <%listed%>",
			"new $houses <%for sale%>",
			"newly listed $houses"
		);

		array_walk($phrases, function(&$str){
			$str .= " <%in the market%>";
		});

		return $this->spinner->spinArray($phrases);
	}
}