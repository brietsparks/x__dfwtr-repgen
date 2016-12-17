<?php namespace SpinnerBundle\Spinner\Model\Passages;

use SpinnerBundle\Spinner\Model\NounPhrases\Inventory as Subject;

class Inventory extends TemplatePassage {

	protected $subjectField = 'inventory';

	protected $aggregation = 'total';

	protected $adjectives = array(
		'listed <%for sale%> <%in the market%>'
	);

	public function subject() {
		return Subject::phrase();
	}
}