<?php

namespace AppBundle\SubdivisionReport;

use AppBundle\Entity\SubdivisionReport;
use AppBundle\Services\ReportParserInterface;
use \DateTime;

class SubdivisionReportParser implements ReportParserInterface
{

    /**
     * @param string $text
     * @return array of SubdivisionReport
     */
    public function parse($text)
    {
        $tableArray = json_decode($text);

        $minRow = $this->getMinRow($tableArray);
        $maxRow = $this->getMaxRow($tableArray);
        $avgRow = $this->getAvgRow($tableArray);

        $subdivisionReport = new SubdivisionReport();

        $subdivisionReport->city = $tableArray[0];
        $subdivisionReport->subdivision = $tableArray[1];
        $subdivisionReport->start = new DateTime($tableArray[2]);
        $subdivisionReport->end = new DateTime($tableArray[3]);

        $this->populateEntity($subdivisionReport, 'sqft', $minRow, $maxRow, $avgRow, 5);
        $this->populateEntity($subdivisionReport, 'price', $minRow, $maxRow, $avgRow, 7);
        $this->populateEntity($subdivisionReport, 'pricePerSqft', $minRow, $maxRow, $avgRow, 8);
        $this->populateEntity($subdivisionReport, 'dom', $minRow, $maxRow, $avgRow, 11);
        $this->populateEntity($subdivisionReport, 'year', $minRow, $maxRow, $avgRow, 12);

        return [$subdivisionReport];
    }

    /**
     * @param SubdivisionReport $subdivisionReport
     * @param string $fieldPrefix the prefix of the SubdivisionReport field (ex: for price_min, it would price)
     * @param array $minRow the row with the min values
     * @param array $maxRow the row with the max values
     * @param array $avgRow the row with the avg values
     * @param int $rowIndex the index which denote the column that the data is found in
     */
    protected function populateEntity(
        SubdivisionReport $subdivisionReport, $fieldPrefix,
        array $minRow, array $maxRow, array $avgRow, $rowIndex
    ) {
        $minField = $fieldPrefix . '_min';
        $maxField = $fieldPrefix . '_max';
        $avgField = $fieldPrefix . '_avg';

        $subdivisionReport->$minField = $this->cleanNumber($minRow[$rowIndex]);
        $subdivisionReport->$maxField = $this->cleanNumber($maxRow[$rowIndex]);
        $subdivisionReport->$avgField = $this->cleanNumber($avgRow[$rowIndex]);
    }

    protected function cleanNumber($str)
    {
        $str = str_replace('$', '', $str);
        $str = str_replace(',', '', $str);
        $str = str_replace(' ', '', $str);
        $str = floatval($str);

        return $str;
    }

    protected function getMinRow(array $tableArray)
    {
        return $this->getRowByFirstElement($tableArray, 'Min');
    }

    protected function getMaxRow(array $tableArray)
    {
        return $this->getRowByFirstElement($tableArray, 'Max');
    }

    protected function getAvgRow(array $tableArray)
    {
        return $this->getRowByFirstElement($tableArray, 'Avg');
    }

    protected function getRowByFirstElement(array $tableArray, $elemValue)
    {
        foreach ($tableArray as $rowArray) {
            if ($rowArray[0] === $elemValue) {
                return $rowArray;
            }
        }
    }

}