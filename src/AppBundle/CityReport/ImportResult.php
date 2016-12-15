<?php

namespace AppBundle\CityReport;

use AppBundle\Services\ScrapeResult;

class ImportResult
{

    /**
     * @var ScrapeResult
     */
    protected $scrapeResult;

    /**
     * @var array
     */
    protected $emptyFields;

    /**
     * @var array
     */
    protected $errors = [];

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
    public function getEmptyFields()
    {
        return $this->emptyFields;
    }

    /**
     * @param array $emptyFields
     *
     * @return ImportResult
     */
    public function setEmptyFields($emptyFields)
    {
        $this->emptyFields = $emptyFields;

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
    public function addErrors($error)
    {
        $this->errors = $error;

        return $this;
    }

}