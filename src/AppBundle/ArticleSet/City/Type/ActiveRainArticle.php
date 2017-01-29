<?php

namespace AppBundle\ArticleSet\City\Type;

use AppBundle\ArticleSet\City\AbstractArticle;
use AppBundle\ArticleSet\City\ArticleInterface;

class ActiveRainArticle extends AbstractArticle
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
        <a href='$domain/idx/search.html?search_city[]=$lcCityName' rel='nofollow'>Click here to view homes in $cityName.</a></p>
        <div style='width: 500px; margin: 20px auto 0 auto'>
        <h3><a href='$domain/blog/$lcCityName-home-values/' rel='nofollow'>$cityName Home Values Report</a></h3>
        </div>
        <div style='clear: both'>&nbsp;</div>
        </div>
        <p><img title='$cityName $reportMonthName Home Values Summary' src='$domain/wp-content/uploads/$thisYear/$thisMonth/$lcCityName-$lcReportMonthName-home-values-summary.jpg' alt='' width='600' /></p>
        ";

        return $text;
    }


}