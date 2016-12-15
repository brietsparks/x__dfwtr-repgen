<?php

namespace AppBundle\CityReport;

use AppBundle\Entity\City;
use AppBundle\Entity\CityReport;
use AppBundle\Services\PdfScraper;
use AppBundle\Services\ScrapeResult;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
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

    /**
     * Import CityReport(s) from the file and return the import results
     *
     * @param UploadedFile $file
     *
     * @return array
     */
    public function import(UploadedFile $file)
    {
        $results = [];

        $scrapes = $this->pdfScraper->scrape($file);

        /** @var ScrapeResult $scraped */
        foreach ($scrapes as $scraped) {
            $result = new ImportResult();
            $result->setScrapeResult($scraped);

            try {
                if (!$scraped->hasErrors()) {
                    /** @var CityReport $cityReport */
                    $cityReport = $this->cityReportParser->parse($scraped->getText());

                    $emptyFields = $cityReport->hasMissingData() ? $cityReport->getMissingDataFields() : [];
                    $result->setEmptyFields($emptyFields);

                    // set the city relationship
                    $repo = $this->entityManager->getRepository(City::class);
                    $city = $repo->findOneByName($cityReport->city);
                    $cityReport->city = $city;

                    // persist
                    if ($city instanceof City) {
                        $this->entityManager->persist($cityReport);
                        $this->entityManager->flush();
                    }
                }
            } catch (\Exception $e) {
                $result->addErrors($e->getMessage());
            }

            $results[] = $result;
        }

        return $results;
    }

}