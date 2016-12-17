<?php namespace App\Spinner\Model\Passages;

use App\Spinner\Model\NounPhrases\ContractListings as Subject;
use App\Spinner\Model\Passages\TemplatePassage;

class ContractListings extends TemplatePassage{

	protected $subjectField = 'contractListings';

	protected $aggregation = 'total';

	protected $adjectives = array(
		'<%listed%> {on|under} <%a%> contract',
	);

	public function subject() {
		return Subject::phrase();
	}

}