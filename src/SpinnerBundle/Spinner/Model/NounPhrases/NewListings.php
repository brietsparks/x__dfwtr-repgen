<?php namespace SpinnerBundle\Spinner\Model\NounPhrases;

use SpinnerBundle\Spinner\Model\NounPhrase;
use SpinnerBundle\Spinner\Model\Words\Nouns\House;

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