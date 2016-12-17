<?php namespace App;

use App\Scraper\PdfScraper;
use App\Models\City;
use App\Spinner\Spinner;
use App\Models\Article;



class ArticlesGenerator {

	/**
	 * @var Spinner
	 */
	protected $spinner;

	/**
	 * @var City
	 */
	public $city;

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
	 * @return string
	 */
	public function generate() {
		$report = "";
		foreach($this->articles() as $key => $article) {
			$report .= $key . "\r\n";
			$report .= $article;
			$report .= "\r\n\r\n\r\n-----------------------------------------------------\r\n";
		}

		return $report;
	}

	public function articles() {
		$city = $this->city->name;
		$cityLc = str_replace(" ", "-", strtolower($city));
		$year = $this->city->getMonthReport()->getCurrentYear()->year;
		$month = $this->city->getMonthReport()->getCurrentYear()->month;
		$date = date_parse($month);
		$monthIdx = sprintf("%02d", $date['month']);

		$articles = array();

		$activeRain = Article::make($this->city)->setFooter(
"<a href='http://www.dfwhomevaluesreport.com/idx/search.html?search_city[]=$cityLc' rel='nofollow'>Click here to view homes in $city.</a></p>
<div style='width: 500px; margin: 20px auto 0 auto'>
<h3><a href='http://www.dfwhomevaluesreport.com/blog/$cityLc-home-values/' rel='nofollow'>$city Home Values Report</a></h3>
</div>
<div style='clear: both'>&nbsp;</div>
</div>
<p><img title='$city $month Home Values Summary' src='http://www.dfwteamrealty.com/wp-content/uploads/$year/$monthIdx/$cityLc-january-home-values-summary.jpg' alt='' width='600' /></p>"
		);
		$articles['Active Rain'] = $activeRain->generate();

		$teamRealty = Article::make($this->city)->setFooter(
"<p>You can <a href='http://www.dfwhomevaluesreport.com/idx/register.html' rel='nofollow'>register</a> on our website to have monthly updates on your city and neighborhood automatically emailed to you from DFW Team Realty. Search $city Texas homes, foreclosures, and short sales to find homes in $city. This service is FREE and available without any obligation from DFWTeamRealty.com.</p>
<img src='http://www.dfwteamrealty.com/wp-content/uploads/$year/$monthIdx/$cityLc-$month-home-values-report.jpg' alt='$city Texas Real Estate $month $year' width='600' height='693' class='aligncenter size-full wp-image-7400' />

<style>#link-to-listings {margin:0 0 15px 0;}#link-to-listings a {text-decoration:none; text-transform:uppercase; font-size:10px; color:#fff;background:#68a; border-radius:5px; padding:5px 6px;}</style>
<p>By <a href='/blog/' rel='author'>Bob Baesmann</a></p>
<div id='link-to-listings'><a href='http://dfwteamrealty.com/$cityLc-homes-and-real-estate'>Click here to view listings in this area</a></div>"
		);
		$articles['DFW Team Realty'] = $teamRealty->generate();

		$homeValues = Article::make($this->city)->setFooter(
"<p>You can <a href='http://www.dfwhomevaluesreport.com/idx/register.html/' rel='nofollow'>register</a> on our website to have monthly updates on your city and neighborhood automatically emailed to you from DFW Home Values Report. Search $city Texas homes, foreclosures, and short sales to find homes in $city. This service is FREE and available without any obligation from DFWHomeValuesReport.com.</p>
<img src='http://www.dfwteamrealty.com/wp-content/uploads/$year/$monthIdx/$cityLc-homesales-$month-$year.jpg' alt='$city Texas Real Estate $month $year'  width='600' height='693' class='aligncenter size-full wp-image-7400' />
<p>By <a href='/blog/' rel='author'>Bob Baesmann</a></p>
<div id='link-to-listings'>
<h2><a href='http://dfwteamrealty.com/$cityLc-homes-and-real-estate'>Click here to view listings in this area</a></h2>
</div>"
		);
		$articles['Home Value Reports'] = $homeValues->generate();

		return $articles;
	}

	protected $months = array(
		'January'
	);









}