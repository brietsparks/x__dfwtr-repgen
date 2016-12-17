<?php

namespace AppBundle\CityReport;

use AppBundle\Entity\CityReport;
use AppBundle\Services\ScrapeResult;

class ImportResult
{

    /**
     * @var CityReport
     */
    protected $cityReport;

    /**
     * @var ScrapeResult
     */
    protected $scrapeResult;

    /**
     * @var array
     */
    protected $dataNotices = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @return CityReport
     */
    public function getCityReport()
    {
        return $this->cityReport;
    }

    /**
     * @param CityReport $cityReport
     * @return ImportResult
     */
    public function setCityReport($cityReport)
    {
        $this->cityReport = $cityReport;

        $emptyFields = $cityReport->hasMissingData() ? $cityReport->getMissingDataFields() : [];
        $emptyFields = array_map(function ($field) {
            return $field . ' was not parsed';
        }, $emptyFields);

        $this->setDataNotices($emptyFields);

        return $this;
    }

    /**
     * @return ScrapeResult
     */
    public function getScrapeResult()
    {
        return $this->scrapeResult;
    }

    /**
     * @param ScrapeResult $scrapeResult
     *
     * @return ImportResult
     */
    public function setScrapeResult($scrapeResult)
    {
        $this->scrapeResult = $scrapeResult;

        return $this;
    }

    /**
     * @return array
     */
    public function getDataNotices()
    {
        return $this->dataNotices;
    }

    /**
     * @param array $dataNotices
     *
     * @return ImportResult
     */
    public function setDataNotices($dataNotices)
    {
        $this->dataNotices = $dataNotices;

        return $this;
    }

    /**
     * @param bool $merge
     *
     * @return array
     */
    public function getErrors($merge = true)
    {
        $errors = $merge ?
            array_merge($this->errors, $this->scrapeResult->getErrors()) :
            $this->errors;

        return $errors;
    }

    /**
     * @param array $error
     *
     * @return ImportResult
     */
    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

}