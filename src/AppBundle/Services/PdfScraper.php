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
        $this->fileSystem = $fileSystem;
        $this->uploadDirPath = $uploadDirPath;
        $this->pdfParser = $pdfParser;
    }

    public function doScrape($tempUploadDirPath, \SplFileInfo $fileInfo, ScrapeResult $scrape)
    {
        try {
            $document = $this->pdfParser->parseFile(
                $tempUploadDirPath . '/' . $fileInfo->getFilename()
            );

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