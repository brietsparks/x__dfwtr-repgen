<?php namespace App\Cleaner;


class Cleaner {

	/**
	 * @var string
	 */
	protected $text;

	/**
	 * Cleaner constructor.
	 * @param string $text
	 */
	public function __construct($text) {
		$this->text = $text;
	}

	/**
	 * @param $text
	 * @return static
	 */
	public static function make($text) {
		return new static($text);
	}

	public function clean() {
		$this->spaces();
		$this->punctuation();
		$this->aan();
		$this->capitalization();
		return $this->text;
	}

	protected function spaces() {
		$text = &$this->text;
		while(strpos($text,"  ")) {
			$text = str_replace("  ", " ", $text);
		}
		if(strpos($text, " ") === 0) {
			$text = ltrim($text," ");
		}
	}

	protected function punctuation() {
		$text = &$this->text;
		while(strpos($text," ,")) {
			$text = str_replace(" ,", ",", $text);
		}
		while(strpos($text," .")) {
			$text = str_replace(" .", ".", $text);
		}
	}

	protected function capitalization() {
		$text = &$this->text;
		$arr = explode(". ", $text);
		foreach($arr as $key => $sentence) {
			$arr[$key] = ucfirst($sentence);
		}
		$text = implode(". ",$arr);
		$text = ucfirst($text);
	}

	protected function aan() {
		$text = &$this->text;
		$text = preg_replace("/a(?=\s[aeiou])/","an",$text);
	}


}