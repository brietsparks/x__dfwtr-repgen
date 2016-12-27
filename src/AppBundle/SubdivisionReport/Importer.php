<?php

namespace AppBundle\SubdivisionReport;

use AppBundle\CityReport\ImportResult;
use AppBundle\Entity\ReportInterface;
use AppBundle\Entity\Subdivision;
use AppBundle\Entity\SubdivisionReport;
use AppBundle\Services\Scraper;
use AppBundle\Services\ScrapeResult;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use AppBundle\Services\Importer as Base;

class Importer extends Base
{

    /**
     * @var SubdivisionReportParser
     */
    protected $cityReportParser;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Importer constructor.
     * @param SubdivisionReportParser $cityReportParser
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(SubdivisionReportParser $cityReportParser, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->cityReportParser = $cityReportParser;
        $this->validator = $validator;
        $this->entityManager = $entityManager;
    }

    public function doImport(ReportInterface $report, ImportResult $result)
    {
        $repo = $this->entityManager->getRepository(Subdivision::class);

        /** @var SubdivisionReport $report */
        $subdivisionName = $report->subdivision;
        $subdivision = $repo->findOneByName($subdivisionName);
        $report->subdivision = $subdivision;

        // persist
        if ($subdivision instanceof Subdivision) {
            $this->entityManager->persist($report);
            $this->entityManager->flush();
        } else {
            $result->addError("Subdivision \"$subdivisionName\" does not exist in database.");
        }
    }


}