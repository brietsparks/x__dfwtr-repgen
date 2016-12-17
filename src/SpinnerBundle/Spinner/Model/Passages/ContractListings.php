<?php namespace SpinnerBundle\Spinner\Model\Passages;

use SpinnerBundle\Spinner\Model\NounPhrases\ContractListings as Subject;
use SpinnerBundle\Spinner\Model\Passages\TemplatePassage;

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