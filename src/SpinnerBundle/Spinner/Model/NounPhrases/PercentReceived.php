<?php namespace SpinnerBundle\Spinner\Model\NounPhrases;

use SpinnerBundle\Spinner\Model\NounPhrase;

class PercentReceived extends NounPhrase {

	public function spin() {

		$phrases = array(
			"percent of <%original%> {list|asking} price received"
		);

		return $this->spinner->spinArray($phrases);
	}

}