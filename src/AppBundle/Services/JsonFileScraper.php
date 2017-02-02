<?php

namespace AppBundle\Services;

class JsonFileScraper extends Scraper
{

    /**
     * @var string
     */
    protected $fileExtension = 'json';

    public function doScrape($filePath, ScrapeResult $scrape)
    {
        try {
            $text = file_get_contents($filePath);

            $scrape->setText($text);
        } catch (\Exception $e) {
            $scrape->addError("
                {$e->getFile()}\r\n
                {$e->getLine()}\r\n
                {$e->getMessage()}
            ");
        }
    }

}