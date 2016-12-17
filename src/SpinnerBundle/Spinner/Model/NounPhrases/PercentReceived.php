<?php namespace App\Spinner\Model\NounPhrases;

use App\Spinner\Model\NounPhrase;

class PercentReceived extends NounPhrase {

	public function spin() {

		$phrases = array(
			"percent of <%original%> {list|asking} price received"
		);

		return $this->spinner->spinArray($phrases);
	}

}