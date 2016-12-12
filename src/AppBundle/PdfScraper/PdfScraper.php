<?php

namespace AppBundle\PdfScraper;

use AppBundle\Entity\CityReport;
use AppBundle\PdfScraper\Extractor\DataPointParserFactory;
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


    public function scrape($text)
    {
        $report = new CityReport();

        $rows = explode("\n", $text);

        foreach ($rows as $row) {
            if ($dataPointParser = $this->dataPointParserFactory->getParser($row)) {

            }
        }
    }

    protected function scrapeCity($text)
    {

    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }


}