<?php namespace SpinnerBundle\Spinner\Model\Passages;

use SpinnerBundle\Spinner\Model\NounPhrases\NewListings as Subject;

class NewListings extends TemplatePassage{

	protected $subjectField = 'newListings';

	protected $aggregation = 'total';

	protected $adjectives = array(
		'newly listed',
		'newly for sale',
		'new on the market'
	);

	public function subject() {
		return Subject::phrase();
	}

}