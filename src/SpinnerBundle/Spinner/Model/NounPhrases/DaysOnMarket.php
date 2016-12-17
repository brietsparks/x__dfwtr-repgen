<?php namespace App\Spinner\Model\NounPhrases;

use App\Spinner\Model\NounPhrase;

class DaysOnMarket extends NounPhrase {

	public function spin() {
		$phrases = array(
			"days on market until sale",
		);

		return $this->spinner->spinArray($phrases);
	}
}