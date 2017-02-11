<?php

namespace AppBundle\ArticleSet\Subdivision\Type;

use AppBundle\ArticleSet\Subdivision\AbstractArticle;
use AppBundle\Entity\SubdivisionReport;

class ActiveRain extends AbstractArticle
{

    function getFooter(SubdivisionReport $report)
    {
        $cityName = $report->getSubdivision()->getCity()->getName();
        $lcCityName = $this->getLcSubdivName($cityName);

        $lcSubName = $this->getLcSubdivName($report->getSubdivision()->getName());

        $year = $report->getEndYear();

        $footer = "
<a rel='nofollow' href='http://www.dfwhomevaluesreport.com/blog/$lcSubName-subdivision-in-$lcCityName-texas-home-values-report-in-$year.html'>Click Here for the full report</a>.</p></a>

<div style='width: 500px; margin: 20px auto 0 auto;'>
<div style='float: left; width: 185px; margin: 10px;'><img title='$cityName Texas Real Estate Report' src='http://www.dfwteamrealty.com/wp-content/uploads/2011/06/market-reports.jpg' alt='' width='185' height='123' /></div>
<div style='float: left; width: 295px;'>
<h3><a rel='nofollow' href='http://www.dfwteamrealty.com/$lcCityName-home-values'>$cityName Texas Real Estate Reports</a></h3>
<p>Register online for monthly updates on your city and neighborhood homes information, automatically emailed to you.</p>

</div>
<div style='clear: both;'>&nbsp;</div>
</div>
        ";

        return $footer;
    }


}