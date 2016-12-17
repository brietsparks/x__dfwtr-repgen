<?php namespace SpinnerBundle\Models;


class CityMeta {

	/**
	 * @var City
	 */
	protected $city;

	/**
	 * @var array
	 */
	protected $aliases = array(
		'Carrollton / ' => ['Carrollton','Farmers Branch'],
		'SE Denton County' => 'Lewisville',
		'Rowlett/Sachse' => ['Rowlett','Sachse'],
		'Dallas NE' => 'Lake Highlands',
		'Park Cities' => ['Highland Park','University Park'],
		'Dallas Uptown' => 'Dallas Uptown including Oaklawn and Turtle Creek',
		'Dallas NW' => 'Dallas Northwest',
		'Aubrey/Pilot Point' => ['Aubrey','Pilot Point'],
		'Fairview/Lucas' => ['Fairview','Lucas'],
		'Lavon/Nevada' => 'Lavon'
	);

	/**
	 * @var array
	 */
	protected $mls = array(
		'Addison'  => 12,
		'Allen'  => 51,
		'Addison'  => 10,
		'Carrollton / Farmers Branch'  => 22,
		'Coppell'  => 31,
		'Corinth'  => 31,
		'Denton'  => 31,
		'Flower Mound'  => 31,
		'Frisco'  => 55,
		'Garland'  => 24,
		'Grapevine'  => 5,
		'Highland Village'  => 22,
		'SE Denton County'  => 41,
		'Little Elm'  => 31,
		'McKinney'  => 53,
		'Mesquite'  => 5,
		'Plano'  => 20,
		'Richardson'  => 23,
		'Rockwall'  => 34,
		'Rowlett/Sachse'  => 8,
		'The Colony'  => 9,
		'Wylie'  => 50,
		'Park Cities'  => 25,
		'Sherman'  => 37,
		'Prosper'  => 59,
		'Pilot Point'  => 31,
		'Dallas NE'  => 18,
		'Irving'  => 54,
		'Park Cities' => 25,
		'Dallas White Rock'  => 12,
		'Dallas Uptown'  => 17,
		'Dallas NW'  => 16,
		'Dallas North'  => 11,
		'Celina'  => 60,
		'Aubrey/Pilot Point'  => 31,
		'Anna'  => 21,
		'Blueridge'  => 67,
		'Fairview/Lucas'  => 52,
		'Melissa'  => 68,
		'Farmersville'  => 58,
		'Lavon/Nevada'  => 56
	);

	/**
	 * @param City $city
	 */
	public function __construct(City $city) {
		$this->city = $city;
	}

	/**
	 * @param City $city
	 * @return static
	 */
	public static function make(City $city) {
		return new static($city);
	}

	/**
	 * @return int|null
	 */
	public function mls() {
		if($this->hasMls()) {
			return $this->mls[$this->city->name];
		} else {
			return null;
		}
	}

	/**
	 * @return bool
	 */
	public function hasMls() {
		return array_key_exists($this->city->name,$this->mls);
	}

	/**
	 * @return array|null
	 */
	public function aliases() {
		if($this->hasAlias()) {
			$aliases = $this->aliases[$this->city->name];
			if (!is_array($aliases)) {
				$aliases = [$aliases];
			}
			return $aliases;
		} else {
			return null;
		}
	}

	/**
	 * @return bool
	 */
	public function hasAlias() {
		return array_key_exists($this->city->name,$this->aliases);
	}
}