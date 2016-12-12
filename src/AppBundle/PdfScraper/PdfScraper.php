<?php

namespace AppBundle\PdfScraper;

use AppBundle\Entity\CityReport;
use AppBundle\PdfScraper\DataPointParserFactory;
use Smalot\PdfParser\Parser as PdfParser;

/**
 * A service for scraping city report pdf's
 *
 * Class PdfScraper
 * @package AppBundle\PdfScraper
 */
class PdfScraper implements ScraperInterface
{

    /**
     * @var PdfParser
     */
    protected $pdfParser;

    /**
     * @var DataPointParserFactory
     */
    protected $dataPointParserFactory;

    /**
     * @var string
     */
    protected $city;

    /**
     * PdfScraper constructor.
     * @param PdfParser $pdfParser
     * @param DataPointParserFactory $dataPointParserFactory
     */
    public function __construct(PdfParser $pdfParser, DataPointParserFactory $dataPointParserFactory)
    {
        $this->pdfParser = $pdfParser;
        $this->dataPointParserFactory = $dataPointParserFactory;
    }

    /**
     * Takes the parsed text from a report and returns the scraped data via CityReport entity
     *
     * @param string $text
     * @return CityReport
     */
    public function scrape($text)
    {
        $report = new CityReport();

        $rows = explode("\n", $text);

//        dump($rows); exit;

        foreach ($rows as $row) {
            if ($dataPointParser = $this->dataPointParserFactory->getParser($row)) {
                $parsedData = $dataPointParser->parse($row);

                foreach ($parsedData as $field => $value) {
                    $report->$field = $value;
                }
            }
        }

        return $report;
    }

}