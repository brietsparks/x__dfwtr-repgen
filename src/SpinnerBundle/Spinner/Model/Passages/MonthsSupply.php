<?php namespace SpinnerBundle\Spinner\Model\Passages;

use SpinnerBundle\Spinner\Model\NounPhrases\MonthsSupply as Subject;

class MonthsSupply extends TemplatePassage {

	protected $subjectField = 'monthsSupply';

	protected $aggregation = 'total';

	protected $adjectives = array(
		'months <%of%> supply'
	);

	public function subject() {
		return Subject::phrase();
	}

}