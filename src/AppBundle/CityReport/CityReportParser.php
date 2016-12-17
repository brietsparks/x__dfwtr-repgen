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
     * @var
     */
    protected $cityMapping;

    /**
     * @var string
     */
    protected $city;

    /**
     * CityReportParser constructor.
     * @param RowParserFactory $dataPointParserFactory
     * @param $cityMapping
     */
    public function __construct(RowParserFactory $dataPointParserFactory, $cityMapping)
    {
        $this->dataPointParserFactory = $dataPointParserFactory;
        $this->cityMapping = $cityMapping;
    }

    /**
     * Takes the parsed text from a report and returns the parsed data via an array of CityReport entities
     *
     * @param string $text
     * @return array of CityReport
     */
    public function parse($text)
    {
        $reports = [];

        $rows = explode("\n", $text);

//        dump($rows);

        $names = $this->resolveCityNames($rows[17], $this->cityMapping);

        foreach ($names as $name) {
            $report = new CityReport();

            $report->city = $name;

            $newListingsParser = new NewListings();

            $this->populateEntity($report, $newListingsParser->parse($rows[3]));

            for ($i = 0; $i < count($rows); $i++) {
                $row = $rows[$i];
                if ($i < 18 && $dataPointParser = $this->dataPointParserFactory->getParser($row)) {
                    $this->populateEntity($report, $dataPointParser->parse($row));
                }
            }

            $reports[] = $report;
        }

//        exit;

        return $reports;
    }

    protected function populateEntity(CityReport $report, array $parsedFields)
    {
        foreach ($parsedFields as $field => $value) {
            if (property_exists(get_class($report), $field)) {
                $report->$field = $value;
            }
        }
    }

    /**
     * Resolve the entity city name(s) based on the parsed city names
     *
     * Some reports such as "Carrollton / Farmers Branch" have multiple cities
     * Other reports such as "Dallas NE" have a alias "Lake Highlands"
     *
     * @param $name
     * @param array $mappings
     * @return array of String
     */
    protected function resolveCityNames($name, array $mappings)
    {
        if (array_key_exists($name, $mappings)) {
            return $mappings[$name];
        } else {
            return [$name];
        }
    }

}