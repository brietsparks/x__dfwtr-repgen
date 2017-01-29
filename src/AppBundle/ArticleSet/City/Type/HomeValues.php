<?php namespace AppBundle\ArticleSet\City\Type;

use AppBundle\ArticleSet\City\AbstractArticle;
use AppBundle\Entity\CityReport;

class HomeValues extends AbstractArticle
{



    public function getFooter($cityName, $reportYear, $reportMonthNumber)
    {
        $homeValuesDomain = "http://www.dfawhomevaluesreport.com";
        $teamRealtyDomain = "http://dfwteamrealty.com"; 

        $lcCityName = $cityName;

        $reportMonthName = $this->getMonthName($reportMonthNumber);
        $lcReportMonthName = $this->getLcMonthNamce($reportMonthNumber);

        $thisYear = $this->getThisYear();
        $thisMonth = $this->getThisMonth();

        $text = "
            <p>You can <a href='$homeValuesDomain/idx/register.html/' rel='nofollow'>register</a> on our website to have monthly updates on your city and neighborhood automatically emailed to you from DFW Home Values Report. Search $cityName Texas homes, foreclosures, and short sales to find homes in $cityName. This service is FREE and available without any obligation from DFWHomeValuesReport.com.</p>
            <img src='$teamRealtyDomain/wp-content/uploads/$thisYear/$thisMonth/$lcCityName-homesales-$reportMonthName-$reportYear.jpg' alt='$cityName Texas Real Estate $reportMonthName 2016'  width='600' height='693' class='aligncenter size-full wp-image-7400' />
            <p>By <a href='/blog/' rel='author'>Bob Baesmann</a></p>
            <div id='link-to-listings'>
            <h2><a href='$teamRealtyDomain/$lcCityName-homes-and-real-estate'>Click here to view listings in this area</a></h2>
            </div>
        ";

        return $text;
    }


}