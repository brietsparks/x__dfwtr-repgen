<?php

namespace AppBundle\Services;

use AppBundle\Form\CityReportImportType;
use Smalot\PdfParser\Parser as PdfParser;
use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PdfScraper
{

    /**
     * @var Filesystem
     */
    protected $fileSystem;

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


    /**
     * @param UploadedFile $file
     * @return array
     */
    public function scrape(UploadedFile $file)
    {
        $scrapes = [];

        // make the temp folder
        $tempDirName = time() . rand();
        $tempUploadDirPath = $this->uploadDirPath . '/' . $tempDirName;
        $this->fileSystem->mkdir($tempUploadDirPath);

        // put pdfs in that folder
        if ($this->fileIsArchive($file)) {
            $this->extractFiles($file, $tempUploadDirPath);
        } elseif($file->getClientOriginalExtension() === 'pdf') {
            $file->move($tempUploadDirPath);
        }

        // scrape the files
        $dir = new \DirectoryIterator($tempUploadDirPath);
        foreach ($dir as $fileInfo) {
            if(!$fileInfo->isDot()) {
                $scrape = new ScrapeResult();

                if ($fileInfo->getExtension() !== 'tmp') {
                    $scrape->setFileName($fileInfo->getFilename());
                }

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

                $scrapes[] = $scrape;
            }
        }

        // delete the temp folder
        $this->fileSystem->remove($tempUploadDirPath);

        return $scrapes;
    }

    protected function extractFiles(UploadedFile $file, $path)
    {
        switch ($file->getClientOriginalExtension()) {
            case 'zip':
                $zip = new \ZipArchive();
                $zip->open($file);
                $zip->extractTo($path);
                break;
            case 'rar':

                break;
        }

    }

    protected function fileIsArchive(UploadedFile $file)
    {
        return in_array($file->getMimeType(), CityReportImportType::ARCHIVE_MIME_TYPES);
    }

}