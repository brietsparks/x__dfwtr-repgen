<?php namespace AppBundle\ArticleSet\City\Type;


use AppBundle\ArticleSet\City\AbstractArticle;
use AppBundle\Entity\CityReport;

class TeamRealty extends AbstractArticle
{

    public function getFooter($cityName, $reportYear, $reportMonthNumber)
    {

        $domain = "http://www.dfwhomevaluesreport.com";

        $lcCityName = $cityName;

        $reportMonthName = $this->getMonthName($reportMonthNumber);
        $lcReportMonthName = $this->getLcMonthNamce($reportMonthNumber);

        $thisYear = $this->getThisYear();
        $thisMonth = $this->getThisMonth();
        
        $text = "
            <p>You can <a href='$domain/idx/register.html' rel='nofollow'>register</a> on our website to have monthly updates on your city and neighborhood automatically emailed to you from DFW Team Realty. Search $cityName Texas homes, foreclosures, and short sales to find homes in $cityName. This service is FREE and available without any obligation from DFWTeamRealty.com.</p>
            <img src='http://www.dfwteamrealty.com/wp-content/uploads/$thisYear/$thisMonth/$lcCityName-$reportMonthName-home-values-report.jpg' alt='$cityName Texas Real Estate $reportMonthName 2016' width='600' height='693' class='aligncenter size-full wp-image-7400' />
            
            <style>#link-to-listings {margin:0 0 15px 0;}#link-to-listings a {text-decoration:none; text-transform:uppercase; font-size:10px; color:#fff;background:#68a; border-radius:5px; padding:5px 6px;}</style>
            <p>By <a href='/blog/' rel='author'>Bob Baesmann</a></p>
            <div id='link-to-listings'><a href='http://dfwteamrealty.com/$lcCityName-homes-and-real-estate'>Click here to view listings in this area</a></div>
        ";

        return $text;
    }


}