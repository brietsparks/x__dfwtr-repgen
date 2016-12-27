<?php

namespace AppBundle\Services;

use Symfony\Component\Finder\Finder;

class JsonFileScraper extends Scraper
{

    /**
     * @var string
     */
    protected $fileExtension = 'json';

    public function doScrape($tempUploadDirPath, \SplFileInfo $fileInfo, ScrapeResult $scrape)
    {
        try {
            $text = file_get_contents($tempUploadDirPath);

            dump($text);exit;

//            $scrape->setText($document->getText());
        } catch (\Exception $e) {
            $scrape->addError("
                        {$e->getFile()}\r\n
                        {$e->getLine()}\r\n
                        {$e->getMessage()}
                    ");
        }
    }

}