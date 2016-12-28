<?php

namespace AppBundle\SubdivisionReport;

use AppBundle\CityReport\ImportResult;
use AppBundle\Entity\City;
use AppBundle\Entity\ReportInterface;
use AppBundle\Entity\Subdivision;
use AppBundle\Entity\SubdivisionReport;
use AppBundle\Services\Importer as Base;

class Importer extends Base
{

    public function doImport(ReportInterface $report, ImportResult $result)
    {
        $subdivisionRepo = $this->entityManager->getRepository(Subdivision::class);
        $cityRepo = $this->entityManager->getRepository(City::class);

        $city = $cityRepo->findOneByName($report->city);

        $subdivision = null;

        if ($city instanceof City) {
            /** @var SubdivisionReport $report */
            $subdivisionName = $report->subdivision;
            $subdivision = $subdivisionRepo->findOneBy(['name' => $subdivisionName, 'city' => $city]);
            $report->subdivision = $subdivision;

            // persist
            if ($subdivision instanceof Subdivision) {
                $this->entityManager->persist($report);
                $this->entityManager->flush();
            } else {
                $result->addError("Subdivision \"$subdivisionName\" does not exist in database.");
            }
        } else {
            $result->addError("City \"{$city->name}\" does not exist in database.");
        }

    }


}