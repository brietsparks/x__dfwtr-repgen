<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Smalot\PdfParser\Object;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/home")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/{city}", name="homepage")
     */
    public function indexAction(Request $request, $city)
    {
        $fileName = "$city.pdf";
        $filePath = $this->get('kernel')->getRootDir() . "\\..\\web\\uploads\\" . $fileName;

        $file = $this->get('file_locator')->locate($filePath);

        $text = $this->get('kreatys.pdf_parser')->parseFile($filePath)->getText();

        $scraper = $this->get('app.pdf_scraper');

        $q = $scraper->scrape($text);

        dump($q);exit;

    }
}
