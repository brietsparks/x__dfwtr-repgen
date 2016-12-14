<?php

namespace AppBundle\Services;

use AppBundle\Form\CityReportImportType;
use Smalot\PdfParser\Parser as PdfParser;
use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PdfScraper
{

    /**
     * @var string
     */
    protected $uploadDirPath;

    /**
     * @var PdfParser
     */
    protected $pdfParser;

    /**
     * PdfScraper constructor.
     * @param string $uploadDirPath
     * @param PdfParser $pdfParser
     */
    public function __construct($uploadDirPath, PdfParser $pdfParser)
    {
        $this->uploadDirPath = $uploadDirPath;
        $this->pdfParser = $pdfParser;
    }

    /**
     * @param UploadedFile $file
     * @return array
     */
    public function scrape(UploadedFile $file)
    {
        $scrapes = [];

        if ($this->fileIsArchive($file)) {
            $this->extractFiles($file, $this->uploadDirPath);
        } else {
            $file->move($this->uploadDirPath);
        }

        $dir = new \DirectoryIterator($this->uploadDirPath);

        foreach ($dir as $fileInfo) {
            if(!$fileInfo->isDot() && $fileInfo->getExtension() === 'pdf') {
                $scrape = new ScrapeResult($fileInfo->getFilename());

                try {
                    $document = $this->pdfParser->parseFile(
                        $this->uploadDirPath . '/' . $fileInfo->getFilename()
                    );
                    $scrape->setText($document->getText());
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

                $scrapes[] = $scrape;
            }
        }

        return $scrapes;
    }

    protected function extractFiles(UploadedFile $file, $path)
    {
        try {
            $zip = new \ZipArchive();
            $zip->open($file);
            $zip->extractTo($path);
        } catch (ContextErrorException $e) {
            die('rar file');
        } finally {
            return false;
        }
    }

    protected function fileIsArchive(UploadedFile $file)
    {
        return in_array($file->getMimeType(), CityReportImportType::ARCHIVE_MIME_TYPES);
    }

}