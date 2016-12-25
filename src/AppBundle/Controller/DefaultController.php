<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CityReport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SpinnerBundle\SubdivSpinner\SubdivisionReport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/home")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, $city)
    {
        $repo = $this->getDoctrine()->getRepository(CityReport::class);

        $rep = $repo->find(215);

        $article = $this->get('app.spinner')->spin($rep);
        dump($article);exit;
    }

    /**
     * @Route("/foo")
     */
    public function fooAction()
    {
        $sr = new SubdivisionReport();

        $article = $this->get('subdiv_article_generator')->generate($sr);

        dump($article);exit;

    }
}
