<?php namespace App\Spinner\Model\Passages;

use App\Spinner\Model\NounPhrases\MonthsSupply as Subject;

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