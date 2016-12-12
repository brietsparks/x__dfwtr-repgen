<?php

namespace AppBundle\PdfScraper;

use Smalot\PdfParser\Parser;

/**
 * A service for scraping city report pdf's
 *
 * Class PdfScraper
 * @package AppBundle\PdfScraper
 */
class PdfScraper implements ScraperInterface
{

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @var string
     */
    protected $city;

    /**
     * Scraper constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function scrape($text)
    {
        $rows = explode("\n", $text);
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