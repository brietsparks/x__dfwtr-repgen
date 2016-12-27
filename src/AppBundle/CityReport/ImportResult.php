<?php

namespace AppBundle\CityReport;

use AppBundle\Entity\ReportInterface;
use AppBundle\Services\ScrapeResult;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ImportResult
{

    /**
     * @var ReportInterface
     */
    protected $report;

    /**
     * @var ScrapeResult
     */
    protected $scrapeResult;

    /**
     * @var array
     */
    protected $skippedFields = [];

    /**
     * @var array
     */
    protected $badFields = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @return ReportInterface
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @param ReportInterface $report
     * @return ImportResult
     */
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }
    

    public function check(ValidatorInterface $validator)
    {
        $report = $this->report;

        foreach ((array) $report->getMissingDataFields() as $field) {
            $this->addSkippedField($field);
        }

        /** @var ConstraintViolation $error */
        foreach ($validator->validate($report) as $error) {
            $this->addBadField("
                {$error->getPropertyPath()} parsed value is {$error->getInvalidValue()}. {$error->getMessage()}
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
    public function getSkippedFields()
    {
        return $this->skippedFields;
    }

    /**
     * @param $skippedField
     * @return $this
     */
    public function addSkippedField($skippedField)
    {
        $this->skippedFields[] = $skippedField;

        return $this;
    }

    /**
     * @return array
     */
    public function getBadFields()
    {
        return $this->badFields;
    }

    /**
     * @param $badField
     * @return $this
     */
    public function addBadField($badField)
    {
        $this->badFields[] = $badField;

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