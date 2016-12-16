<?php

namespace AppBundle\CityReport;

use AppBundle\CityReport\RowParser\NewListings;
use AppBundle\Entity\CityReport;

/**
 * Parses city report text row by row into a CityReport object
 *
 * Class CityReportParser
 * @package AppBundle\CityReportParser
 */
class CityReportParser
{

    /**
     * @var RowParserFactory
     */
    protected $dataPointParserFactory;

    /**
     * @var string
     */
    protected $city;

    /**
     * CityReportParser constructor.
     * @param RowParserFactory $dataPointParserFactory
     */
    public function __construct(RowParserFactory $dataPointParserFactory)
    {
        $this->dataPointParserFactory = $dataPointParserFactory;
    }

    /**
     * Takes the parsed text from a report and returns the parsed data via CityReport entity
     *
     * @param string $text
     * @return CityReport
     */
    public function parse($text)
    {
        $report = new CityReport();

        $rows = explode("\n", $text);

        $report->city = $rows[17];

        $newListingsParser = new NewListings();
        $this->populateEntity($report, $newListingsParser->parse($rows[3]));

        foreach ($rows as $row) {
            if ($dataPointParser = $this->dataPointParserFactory->getParser($row)) {
                $this->populateEntity($report, $dataPointParser->parse($row));
            }
        }

        return $report;
    }

    protected function populateEntity(CityReport $report, array $parsedFields)
    {
        foreach ($parsedFields as $field => $value) {
            if (property_exists(get_class($report), $field)) {
                $report->$field = $value;
            }
        }
    }

}