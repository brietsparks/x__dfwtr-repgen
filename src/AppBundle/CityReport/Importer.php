<?php

namespace AppBundle\CityReport;

use AppBundle\Entity\CityReport;
use AppBundle\Services\PdfScraper;
use AppBundle\Services\ScrapeResult;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Importer
{

    /**
     * @var PdfScraper
     */
    protected $pdfScraper;

    /**
     * @var CityReportParser
     */
    protected $cityReportParser;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Importer constructor.
     * @param PdfScraper $pdfScraper
     * @param CityReportParser $cityReportParser
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(PdfScraper $pdfScraper, CityReportParser $cityReportParser, EntityManagerInterface $entityManager)
    {
        $this->pdfScraper = $pdfScraper;
        $this->cityReportParser = $cityReportParser;
        $this->entityManager = $entityManager;
    }

    public function import(UploadedFile $file)
    {
        $scrapes = $this->pdfScraper->scrape($file);

        /** @var ScrapeResult $scraped */
        foreach ($scrapes as $scraped) {
            if (!$scraped->hasErrors()) {
                /** @var CityReport $cityReport */
                $cityReport = $this->cityReportParser->parse($scraped->getText());

                $emptyFields = $cityReport->hasMissingData() ? $cityReport->getMissingDataFields() : null;

                dump($emptyFields);
                dump($cityReport->getDataPoints());


//                $this->entityManager->persist($cityReport);
//                $this->entityManager->flush();
            }
        }

        exit;
    }

    protected function checkReportCompletion(CityReport $cityReport)
    {

    }

    public function getResults()
    {

    }

}