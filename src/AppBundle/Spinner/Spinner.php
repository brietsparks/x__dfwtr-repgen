<?php

namespace AppBundle\Spinner;

use SpinnerBundle\Models\City as LegacyCity;
use AppBundle\Entity\CityReport;
use SpinnerBundle\ArticlesGenerator;

class Spinner
{

    /**
     * @var ArticlesGenerator
     */
    protected $legacySpinner;

    /**
     * Spinner constructor.
     * @param ArticlesGenerator $legacySpinner
     */
    public function __construct(ArticlesGenerator $legacySpinner)
    {
        $this->legacySpinner = $legacySpinner;
    }

    public function spin(CityReport $cityReport)
    {
        $legacyCity = $this->getLegacyCity($cityReport);

        $article = $this->legacySpinner->setCity($legacyCity)->articles();

        return $article;
    }

    protected function getLegacyCity(CityReport $cityReport)
    {
        $legacyCity = new LegacyCity();

        $legacyCity->name = $cityReport->getCity()->getName();
        $legacyCity->mls = $cityReport->getCity()->getMls();

        $monthNum  = $cityReport->month;
        $dateObj   = \DateTime::createFromFormat('!m', $monthNum);
        $month = $dateObj->format('F'); // March

        $legacyCity->getMonthReport()->getPreviousYear()->month = $month;
        $legacyCity->getMonthReport()->getCurrentYear()->month = $month;
        $legacyCity->getYtdReport()->getPreviousYear()->month = $month;
        $legacyCity->getYtdReport()->getCurrentYear()->month = $month;

        $year = $cityReport->year;
        $legacyCity->getMonthReport()->getPreviousYear()->year = $year - 1;
        $legacyCity->getMonthReport()->getCurrentYear()->year = $year;
        $legacyCity->getYtdReport()->getPreviousYear()->year = $year - 1;
        $legacyCity->getYtdReport()->getCurrentYear()->year = $year;

        $legacyCity->getMonthReport()->getPreviousYear()->inventory = $cityReport->inventory_monthPrev;
        $legacyCity->getMonthReport()->getCurrentYear()->inventory = $cityReport->inventory_monthCurr;
        $legacyCity->getMonthReport()->getChange()->inventory = $cityReport->inventory_monthChange;

        $legacyCity->getMonthReport()->getPreviousYear()->monthsSupply = $cityReport->monthsSupply_monthPrev;
        $legacyCity->getMonthReport()->getCurrentYear()->monthsSupply = $cityReport->monthsSupply_monthCurr;
        $legacyCity->getMonthReport()->getChange()->monthsSupply = $cityReport->monthsSupply_monthChange;

        $this->populateLegacyCity($legacyCity, 'newListings', $cityReport, 'newListings');
        $this->populateLegacyCity($legacyCity, 'salesReported', $cityReport, 'salesReported');
        $this->populateLegacyCity($legacyCity, 'salesProjected', $cityReport, 'salesProjected');
        $this->populateLegacyCity($legacyCity, 'contractListings', $cityReport, 'contractListings');
        $this->populateLegacyCity($legacyCity, 'averagePrice', $cityReport, 'avgPrice');
        $this->populateLegacyCity($legacyCity, 'medianPrice', $cityReport, 'medianPrice');
        $this->populateLegacyCity($legacyCity, 'percentReceived', $cityReport, 'percentReceived');
        $this->populateLegacyCity($legacyCity, 'daysOnMarket', $cityReport, 'daysOnMarket');

        return $legacyCity;
    }

    protected function populateLegacyCity(LegacyCity $legacyCity, $legacyField, CityReport $cityReport, $cityReportFieldPrefix)
    {
        $pre = $cityReportFieldPrefix;

        $legacyCity->getMonthReport()->getPreviousYear()->$legacyField = $cityReport->{$pre . "_monthPrev"};
        $legacyCity->getMonthReport()->getCurrentYear()->$legacyField = $cityReport->{$pre . "_monthCurr"};
        $legacyCity->getMonthReport()->getChange()->$legacyField = $cityReport->{$pre . "_monthChange"};
        $legacyCity->getYtdReport()->getPreviousYear()->$legacyField = $cityReport->{$pre . "_ytdPrev"};
        $legacyCity->getYtdReport()->getCurrentYear()->$legacyField = $cityReport->{$pre . "_ytdCurr"};
        $legacyCity->getYtdReport()->getChange()->$legacyField = $cityReport->{$pre . "_ytdChange"};
    }

}