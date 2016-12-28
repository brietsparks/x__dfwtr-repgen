<?php

namespace AppBundle\Services;

use AppBundle\Form\CityReportImportType;
use Smalot\PdfParser\Parser as PdfParser;
use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PdfScraper extends Scraper
{

    /**
     * @var PdfParser
     */
    protected $pdfParser;

    /**
     * @var string
     */
    protected $fileExtension = 'pdf';

    /**
     * PdfScraper constructor.
     *
     * @param Filesystem $fileSystem
     * @param string $uploadDirPath
     * @param PdfParser $pdfParser
     */
    public function __construct(Filesystem $fileSystem, $uploadDirPath, PdfParser $pdfParser)
    {
        parent::__construct($fileSystem,$uploadDirPath);
        $this->pdfParser = $pdfParser;
    }

    public function doScrape($filePath, ScrapeResult $scrape)
    {
        try {
            $document = $this->pdfParser->parseFile($filePath);

            $scrape->setText($document->getText());
        } catch (\Exception $e) {
            $scrape->addError("
                        {$e->getFile()}\r\n
                        {$e->getLine()}\r\n
                        {$e->getMessage()}
                    ");
        }
    }


}