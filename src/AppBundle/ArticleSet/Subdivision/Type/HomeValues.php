<?php namespace AppBundle\ArticleSet\Subdivision\Type;


use AppBundle\ArticleSet\Subdivision\AbstractArticle;
use AppBundle\Entity\SubdivisionReport;

class HomeValues extends AbstractArticle
{

    function getFooter(SubdivisionReport $report)
    {
        $subName = $report->getSubdivision()->getName();

        $footer = "
<p>DFW Team Realty is your local expert specializing in home sales in the $subName subdivision, 
as well as home foreclosures and short sales in the $subName subdivision. 
If you are looking to buy or sell a home in $subName, contact DFW Team Realty or 
<a rel='nofollow' href='http://www.dfwhomevaluesreport.com/idx/register.html'>  visit us online</a> 
to receive updates on home values in your city and neighborhood.</p>
        ";

        return $footer;
    }


}