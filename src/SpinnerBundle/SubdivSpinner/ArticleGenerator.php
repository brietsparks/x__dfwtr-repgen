<?php

namespace SpinnerBundle\SubdivSpinner;

use AppBundle\Entity\SubdivisionReport as EntityReport;
use SpinnerBundle\SubdivSpinner\SubdivisionReport as SpinnerReport;

class ArticleGenerator
{

    /**
     * @var Sentences
     */
    protected $sentences;

    public function __construct()
    {
        $this->sentences = new Sentences();
    }

    public function spin(EntityReport $entityReport)
    {
        $spinnerReport = new SpinnerReport();
        $spinnerReport->minSqft = $entityReport->sqft_min;
        $spinnerReport->maxSqft = $entityReport->sqft_max;
        $spinnerReport->avgSqft = $entityReport->sqft_avg;
        $spinnerReport->minPrice = $entityReport->price_min;
        $spinnerReport->maxPrice = $entityReport->price_max;
        $spinnerReport->avgPrice = $entityReport->price_avg;
        $spinnerReport->minPricePerSqft = $entityReport->pricePerSqft_min;
        $spinnerReport->maxPricePerSqft = $entityReport->pricePerSqft_max;
        $spinnerReport->avgPricePerSqft = $entityReport->pricePerSqft_avg;
        $spinnerReport->minDom = $entityReport->dom_min;
        $spinnerReport->maxDom = $entityReport->dom_max;
        $spinnerReport->avgDom = $entityReport->dom_avg;
        $spinnerReport->minYearBuild = $entityReport->year_min;
        $spinnerReport->maxYearBuild = $entityReport->year_max;
        $spinnerReport->avgYearBuild = $entityReport->year_avg;

        return $this->generate($spinnerReport);
    }

    public function getTitle(EntityReport $report)
    {
        $year = $report->getEndYear();
        $thisYear = $year + 1;
        $subName = $report->getSubdivision()->getName();
        $cityName = $report->getSubdivision()->getCity()->getName();

        $title = "$subName Subdivision in $cityName, Texas Home Sales Trends $thisYear Report (Year-Ending $year)";

        return $title;
    }

    public function generate(SpinnerReport $sr)
    {
        $sentences = $this->sentences;

        $article = [
            $sentences->sqftParagraph($sr),
            $sentences->priceParagraph($sr),
            $sentences->pricePerSqftParagraph($sr),
            $sentences->domParagraph($sr),
            $sentences->yearParagraph($sr)
        ];

        shuffle($article);

        return implode(' ', $article);

    }

}