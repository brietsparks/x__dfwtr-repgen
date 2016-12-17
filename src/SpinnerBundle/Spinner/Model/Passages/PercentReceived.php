<?php namespace SpinnerBundle\Spinner\Model\Passages;

use SpinnerBundle\Spinner\Model\NounPhrases\PercentReceived as Subject;

class PercentReceived extends TemplatePassage{

	protected $subjectField = 'percentReceived';

	protected $aggregation = 'total';

	protected $continuous = true;

	protected $adjectives = array(
		'percent'
	);

	public function subject() {
		return Subject::phrase();
	}
}