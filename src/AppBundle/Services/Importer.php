<?php 

namespace AppBundle\Services;

use AppBundle\CityReport\ImportResult;
use AppBundle\Entity\ReportInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class Importer
{

    /**
     * @var Scraper
     */
    protected $scraper;

    /**
     * @var ReportParserInterface
     */
    protected $parser;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(Scraper $scraper, ReportParserInterface $parser, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->scraper = $scraper;
        $this->parser = $parser;
        $this->validator = $validator;
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

        $scrapes = $this->scraper->scrape($file);

        /** @var ScrapeResult $scraped */
        foreach ($scrapes as $scraped) {
            if (!$scraped->hasErrors()) {
                $reports = $this->parser->parse($scraped->getText());
                
                foreach ($reports as $report) {
                    $results[] = $this->importOne($report, $scraped);
                }
            }
        }

        return $results;
    }

    /**
     * @param ReportInterface $report
     * @param ScrapeResult $scraped
     * @return ImportResult
     */
    public function importOne(ReportInterface $report, ScrapeResult $scraped)
    {
        $result = new ImportResult();
        $result->setScrapeResult($scraped);

        try {
            $result->setReport($report)->check($this->validator);

            $this->doImport($report, $result);
        } catch (\Exception $e) {
            $result->addError("
                {$e->getFile()},\r\n  
                line {$e->getLine()},\r\n 
                {$e->getMessage()}
            ");
        }

        return $result;
    }

    abstract public function doImport(ReportInterface $report, ImportResult $result);
    

}