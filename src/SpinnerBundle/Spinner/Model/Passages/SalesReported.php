<?php namespace SpinnerBundle\Spinner\Model\Passages;

use SpinnerBundle\Spinner\Model\NounPhrases\SalesReported as Subject;

class SalesReported extends TemplatePassage {

	protected $subjectField = 'salesReported';

	protected $aggregation = 'total';

	protected $adjectives = array(
		'sold'
	);

	public function subject() {
		return Subject::phrase();
	}

}
