<?php

namespace AppBundle\CityReport;

use AppBundle\Entity\City;
use AppBundle\Entity\CityReport;
use AppBundle\Entity\ReportInterface;
use AppBundle\Services\Importer as Base;

class Importer extends Base
{
    public function doImport(ReportInterface $report, ImportResult $result)
    {
        // set the city relationship
        $repo = $this->entityManager->getRepository(City::class);

        /** @var CityReport $report */
        $cityName = $report->city;
        $city = $repo->findOneByName($cityName);
        $report->city = $city;

        // persist
        if ($city instanceof City) {
            $this->entityManager->persist($report);
            $this->entityManager->flush();
        } else {
            $result->addError("City \"$cityName\" does not exist in database.");
        }
    }




}