<?php namespace SpinnerBundle\Spinner\Model\NounPhrases;

use SpinnerBundle\Spinner\Model\NounPhrase;

class DaysOnMarket extends NounPhrase {

	public function spin() {
		$phrases = array(
			"days on market until sale",
		);

		return $this->spinner->spinArray($phrases);
	}
}