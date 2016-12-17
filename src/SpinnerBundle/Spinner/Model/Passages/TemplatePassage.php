<?php namespace App\Spinner\Model\Passages;

use App\Models\City;
use App\Spinner\Model\NounPhrase;
use App\Spinner\Model\Passage;
use App\Spinner\Model\Phrases\PercentDifferenceFactory as Difference;
use App\Spinner\Model\Words\Nouns\House;
use App\Cleaner\Cleaner;

abstract class TemplatePassage extends Passage {

	/**
	 * @var City
	 */
	public $city;

	/**
	 * @var NounPhrase
	 */

	/**
	 * The field name of interest, which is a property of the Report class
	 * @var string
	 */
	protected $subjectField;

	/**
	 * @var string
	 */
	protected $subject;

	/**
	 * @var array
	 */
	protected $adjectives = array();

	/**
	 * @var string
	 */
	protected $aggregation;

	/**
	 * @var bool
	 */
	protected $continuous;

	/**
	 * @var bool
	 */
	protected $compare;

	abstract public function subject();

	public function spin() {
		return $this->fullPassage();
	}

	public function monthPassage() {
		$houses = House::plural();
		$change = Difference::make($this->monthChange())->get();
		$subject = $this->subject();
		$setting = $this->monthSetting();

		$subjectPhrase = $this->spinner->spinArray(
			array(
				"<%{$this->aggregationTerm()}%> $subject $setting[0] $setting[1]",
				"$setting[0] <%{$this->aggregationTerm()}%> $subject $setting[1]",
				"$setting[0] $setting[1] <%{$this->aggregationTerm()}%> $subject",
			)
		);

		$changePhrase = $this->spinner->spinArray(array(
			"{$change->verbPhrase()}",
			"was {$change->adjPhrase()}",
			"{saw} {$change->nounPhrase()}"
		));

		$conjunction = "{and this was|which was}";

		$month = array(
			"$subjectPhrase $changePhrase {$this->comparison()}, with {$this->monthQty()} $subject <%{$this->aggregation}%> this month.",
			"$subjectPhrase {reached|was <%at%>} {$this->monthQty()} <%{$this->aggregation}%>, {$change->nounPhrase()} {$this->comparison()}.",
			"$subjectPhrase {saw|experienced|had|underwent|showed} {$change->nounPhrase()} {$this->comparison()}, with {$this->monthQty()} {$this->adjective()} {$this->aggregation}.",
		);

		if($this->continuous !== true) {
			$month = array_merge(
				$month,
				array(
					"$setting[0] there were {$this->monthQty()} $subject $setting[1], $conjunction {$change->nounPhrase()} {$this->comparison()}.",
					"$setting[0] there was {$change->nounPhrase()} in <% the number of%> $subject $setting[1] {$this->comparison()}. There were {$this->monthQty()} $subject {$this->aggregation} this month."
				)
			);
		}

		$text = $this->spinner->spinArray($month);
		$text = Cleaner::make($text)->clean();

		return $text;
	}

	public function ytdPassage() {
		$houses = House::plural();
		$subject = $this->subject();
		$change = Difference::make($this->ytdChange())->get();
		$setting = $this->ytdSetting();

		$subjectPhrase = $this->spinner->spinArray(
			array(
				"<% the number of%> $subject $setting[0] $setting[1]",
				"$setting[0] <% the number of%> $subject $setting[1]",
				"$setting[0] $setting[1] <% the number of%> $subject",
			)
		);

		$changePhrase = $this->spinner->spinArray(array(
			"{$change->verbPhrase()}",
			"was {$change->adjPhrase()}",
			"{saw} {$change->nounPhrase()}"
		));

		$conjunction = "{and this was|which was}";

		$ytd = array(
			"$subjectPhrase $changePhrase {$this->comparison()}, with {$this->ytdQty()} $subject <%{$this->aggregation}%> this year.",
			"$subjectPhrase {reached|was <%at%>} {$this->ytdQty()} <%{$this->aggregation}%>, {$change->nounPhrase()} {$this->comparison()}.",
			"$subjectPhrase {saw|experienced|had|underwent|showed} {$change->nounPhrase()} {$this->comparison()}, with {$this->ytdQty()} {$this->adjective()} {$this->aggregation} this year.",
		);

		if($this->continuous !== true) {
			$ytd = array_merge(
				$ytd,
				array(
					"$setting[0] there were {$this->ytdQty()} $subject $setting[1], $conjunction {$change->nounPhrase()} {$this->comparison()}.",
					"$setting[0] there was {$change->nounPhrase()} in <% the number of%> $subject $setting[1] {$this->comparison()}. There were {$this->ytdQty()} $subject <%{$this->aggregation}%> this year.",
				)
			);
		}

		$text = $this->spinner->spinArray($ytd);
		$text = Cleaner::make($text)->clean();

		return $text;
	}

	public function fullPassage() {
		$arr = array();
		$i = mt_rand(0,1);
		$j = $i === 1 ? 0 : 1;
		$arr[$i] = $this->monthPassage();
		$arr[$j] = $this->ytdPassage();
		$text = concatenate($arr);
		return $text;
	}

	public function adjective() {
		return $this->spinner->spinArray($this->adjectives);
	}

	protected function monthSetting() {
		$setting = array();
		$i = mt_rand(0,1);
		$j = $i === 1 ? 0 : 1;

		$setting[$i] = $this->prepCity();
		$setting[$j] = $this->prepMonth();

		return $setting;
	}

	protected function ytdSetting() {
		$setting = array();
		$i = mt_rand(0,1);
		$j = $i === 1 ? 0 : 1;

		$setting[$i] = $this->prepCity();
		$setting[$j] = "year to date";

		return $setting;
	}

	public function prepCity() {
		return $this->spinner->spinString("<%in {$this->city->name}%>");
	}

	public function prepMonth() {
		return $this->spinner->spinString("{this month|in {$this->monthName()} {$this->year()}}");
	}

	/**
	 * @param boolean $compare
	 * @return TemplatePassage
	 */
	public function setCompare($compare = true) {
		$this->compare = $compare;

		return $this;
	}

	/**
	 * @return string
	 */
	public function comparison() {
		$comparison = '';
		if($this->compare) {
			$comparedTo = $this->spinner->spinString("{{compared to|relative to|in contrast to}|from}");
			$theSamePeriod = $this->spinner->spinArray(
				array(
					"the same {point in time|time of year|period|month|month}",
					$this->city->getMonthReport()->getCurrentYear()->month
				)
			);

			$lastYear = $this->spinner->spinArray(
				array(
					$this->city->getMonthReport()->getPreviousYear()->year,
					"last year",
				)
			);

			$comparison =  $this->spinner->spinString("$comparedTo <%$theSamePeriod%> $lastYear");
		}
		return $comparison;
	}

	protected function aggregationTerm() {
		$term = "";
		if($this->aggregation) {
			if($this->aggregation == 'total') {
				if($this->continuous) {
					$term = "the total";
				} else {
					$term = "the number of";
				}
			} else {
				$term = "the {$this->aggregation} of";
			}
		}
		return $term;
	}

	/**
	 * @param City $city
	 * @return TemplatePassage
	 */
	public function setCity($city) {
		$this->city = $city;

		return $this;
	}

	public function monthName() {
		return $this->city->getMonthReport()->getCurrentYear()->month;
	}

	public function year() {
		return $this->city->getMonthReport()->getCurrentYear()->year;
	}

	public function monthQty() {
		return $this->city->getMonthReport()->getCurrentYear()->{$this->subjectField};
	}

	public function monthChange() {
		return $this->city->getMonthReport()->getChange()->{$this->subjectField};
	}

	public function ytdQty() {
		return $this->city->getYtdReport()->getCurrentYear()->{$this->subjectField};
	}

	public function ytdChange() {
		return $this->city->getYtdReport()->getChange()->{$this->subjectField};
	}

}