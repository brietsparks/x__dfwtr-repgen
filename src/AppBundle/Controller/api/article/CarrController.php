<?php

namespace AppBundle\Controller\api\article;

use AppBundle\Entity\City;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\CityReport;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * CityReport controller.
 *
 * @Route("api/v1/article/carr")
 */
class CarrController extends Controller {

    /**
     * Finds and displays a CityReport entity.
     *
     * @Route("/{name}/{year}/{month}", name="api_city_article_show")
     * @Method("GET")
     */
    public function show($name, $year, $month)
    {
        $cityRepo = $this->getDoctrine()->getRepository(City::class);
        $reportRepo = $this->getDoctrine()->getRepository(CityReport::class);

        /** @var City $city */
        $city = $cityRepo->findOneByName($name);

        $report = $reportRepo->findOneBy([
            'city' => $city,
            'year' => $year,
            'month' => $month
        ]);

        $article = $this->get('app.spinner')->spin($report);
        $report->city = $city->getName();

        $data = [
            'data' => $report,
            'article' => $article
        ];

        return new JsonResponse($data);
    }

}