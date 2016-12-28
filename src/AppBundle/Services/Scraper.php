<?php

namespace AppBundle\Services;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class Scraper
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
     * The extension of the type of file to be scraped by this class
     * Overwrite in subclass
     *
     * @var string
     */
    protected $fileExtension;

    /**
     * PdfScraper constructor.
     *
     * @param Filesystem $fileSystem
     * @param string $uploadDirPath
     */
    public function __construct(Filesystem $fileSystem, $uploadDirPath)
    {
        $this->fileSystem = $fileSystem;
        $this->uploadDirPath = $uploadDirPath;
    }

    /**
     * Steps for scraping, implement in subclass
     *
     * @param string $filepath
     * @param ScrapeResult $scrape
     */
    abstract public function doScrape($filepath, ScrapeResult $scrape);

    /**
     * Overwrite in subclass
     *
     * @return array
     */
    protected function getFileMimeTypes()
    {
        return [];
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

        $this->fileSystem->chmod($tempUploadDirPath, '222');
        $this->fileSystem->remove($tempUploadDirPath);

        // put pdfs in that folder
        if ($this->fileIsArchive($file)) {
            $this->extractFiles($file, $tempUploadDirPath);
        } elseif($file->getClientOriginalExtension() === $this->fileExtension) {
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

                $this->doScrape($tempUploadDirPath . '/' . $fileInfo->getFilename(), $scrape);

                $scrapes[] = $scrape;
            }
        }

        // delete the temp folder
        $this->fileSystem->remove($tempUploadDirPath);

        return $scrapes;
    }

    /**
     * @param UploadedFile $file
     * @return bool
     */
    protected function fileIsArchive(UploadedFile $file)
    {
        return in_array($file->getMimeType(), $this->getFileMimeTypes());
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     */
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

}