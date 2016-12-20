<?php namespace SpinnerBundle\Spinner;
/**
 * Spintax - A helper class to process Spintax strings.
 * @name Spintax
 * @author Jason Davis - https://www.codedevelopr.com/
 * Tutorial: https://www.codedevelopr.com/articles/php-spintax-class/
 */

class Spinner
{

    public function spin($spinnable)
    {
        if (is_array($spinnable)) {
            return $this->spinArray($spinnable);
        } else {
            return $this->spinString($spinnable);
        }
    }

	/**
	 * @param $string
	 * @return string
	 */
	public function spinString($string) {
		return $this->process($string);
	}

	/**
	 * @param array $array
	 * @return string
	 */
	public function spinArray(array $array) {
		$string = '';

		foreach($array as $item) {
			$string .= $item . "|";
		}
		$string = "{" . rtrim($string,"|") . "}";

		return $this->process($string);
	}

	/**
	 * @param $text
	 * @return string
	 */
	public function process($text)
	{

		preg_match_all("'<%(.*?)%>'si", $text, $match);
		foreach ($match[0] as $key => $element) {
			if (mt_rand(0,1) == 0) {
				$text = str_replace($element,'',$text);
			} else {
				$text = str_replace($element,$match[1][$key],$text);
			}
		}

		return preg_replace_callback(
			'/\{(((?>[^\{\}]+)|(?R))*)\}/x',
			array($this, 'replace'),
			$text
		);
	}

	/**
	 * @param $text
	 * @return mixed
	 */
	public function replace($text)
	{
		$text = $this->process($text[1]);
		$parts = explode('|', $text);
		return $parts[array_rand($parts)];
	}



}