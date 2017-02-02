<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CityReport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SpinnerBundle\SubdivSpinner\SubdivisionReport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, $city)
    {
        if ($this->userIsAuthenticated()) {
            return $this->redirectToRoute("city");
        }

        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * @return bool
     */
    protected function userIsAuthenticated()
    {
        return $this->container->get('security.authorization_checker')
            ->isGranted('IS_AUTHENTICATED_FULLY');
    }


}
