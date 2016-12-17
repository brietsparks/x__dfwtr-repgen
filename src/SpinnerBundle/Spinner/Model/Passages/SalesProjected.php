<?php namespace App\Spinner\Model\Passages;

use App\Spinner\Model\NounPhrases\SalesProjected as Subject;

class SalesProjected extends TemplatePassage {

	protected $subjectField = 'salesProjected';

	protected $aggregation = 'total';

	protected $adjectives = array(
		'projected'
	);

	public function subject() {
		return Subject::phrase();
	}



}