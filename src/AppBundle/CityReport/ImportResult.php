<?php

namespace AppBundle\CityReport;

use AppBundle\Entity\CityReport;
use AppBundle\Services\ScrapeResult;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

        return $this;
    }

    public function check(ValidatorInterface $validator)
    {
        $cityReport = $this->cityReport;

        foreach ((array) $cityReport->getMissingDataFields() as $field) {
            $this->addDataNotice($field . ' was not parsed');
        }

        $errors = $validator->validate($cityReport);

        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $this->addDataNotice("
                {$error->getPropertyPath()} parsed value is {$error->getInvalidValue()}. {$error->getMessage()}.
            ");
        }
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
     * @param mixed $dataNotice
     *
     * @return ImportResult
     */
    public function addDataNotice($dataNotice)
    {
        $this->dataNotices[] = $dataNotice;

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