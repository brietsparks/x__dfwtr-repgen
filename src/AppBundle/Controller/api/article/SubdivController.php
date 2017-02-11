<?php

namespace AppBundle\Controller\api\article;

use \DateTime;
use AppBundle\Entity\City;
use AppBundle\Entity\Subdivision;
use AppBundle\Entity\SubdivisionReport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/v1/article/subdivision")
 */
class SubdivController extends Controller
{

    /**
     * @Route("/{cityName}/{subdivisionName}/{endMonth}/{endDay}/{endYear}", name="api_subdiv_article_show")
     *
     * @Method("GET")
     */
    public function show($cityName, $subdivisionName, $endMonth, $endDay, $endYear)
    {
        $doctrine = $this->getDoctrine();
        $cityRepo = $doctrine->getRepository(City::class);
        $subdivRepo = $doctrine->getRepository(Subdivision::class);
        $reportRepo = $doctrine->getRepository(SubdivisionReport::class);

        /** @var City $city */
        $city = $cityRepo->findOneByName($cityName);

        $subdivision = $subdivRepo->findOneBy([
            'city' => $city,
            'name' => $subdivisionName
        ]);

        $endDate = new DateTime("$endMonth/$endDay/$endYear");
        $report = $reportRepo->findOneBy([
            'subdivision' => $subdivision,
            'end' => $endDate
        ]);

        $title = $this->get('subdiv_article_generator')->getTitle($report);
        $article = $this->get('subdiv_article_generator')->spin($report);

        $data = [
            'data' => $report,
            'article' => [
                'title' => $title,
                'body' => $article
            ]
        ];

        return new JsonResponse($data);
    }

}