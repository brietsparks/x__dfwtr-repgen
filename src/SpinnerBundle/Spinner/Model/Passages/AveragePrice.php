<?php namespace App\Spinner\Model\Passages;

use App\Spinner\Model\NounPhrases\AveragePrice as Subject;

class AveragePrice extends TemplatePassage {

	protected $subjectField = 'averagePrice';

	protected $aggregation = 'average';

	protected $continuous = true;

	protected $adjectives = array(
		'dollars',
	);

	public function subject() {
		return Subject::phrase();
	}


}