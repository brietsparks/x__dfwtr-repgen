<?php

namespace AppBundle\Importer;

use AppBundle\Form\CityReportImportType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CityReportImporter
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $uploadDirPath;

    protected $results;

    /**
     * CityReportImporter constructor.
     * @param EntityManager $entityManager
     * @param string $uploadDirPath
     */
    public function __construct(EntityManager $entityManager, $uploadDirPath)
    {
        $this->entityManager = $entityManager;
        $this->uploadDirPath = $uploadDirPath;
    }


    public function import(UploadedFile $file)
    {
        if ($this->fileIsArchive($file)) {
            $zip = new \ZipArchive();

            $zip->open($file);
            
            $zip->extractTo($this->uploadDirPath);
        } else {
            dump(2);exit;
        }

        return $this;
    }


    public function getResults()
    {
        return $this->results;
    }

    protected function fileIsArchive(UploadedFile $file)
    {
        return in_array($file->getMimeType(), CityReportImportType::ARCHIVE_MIME_TYPES);
    }

    /**
     * @param string $uploadDirPath
     * @return CityReportImporter
     */
    public function setUploadDirPath($uploadDirPath)
    {
        $this->uploadDirPath = $uploadDirPath;

        return $this;
    }



}