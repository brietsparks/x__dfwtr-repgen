<?php namespace App\Spinner\Model\Passages;

use App\Spinner\Model\NounPhrases\NewListings as Subject;

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