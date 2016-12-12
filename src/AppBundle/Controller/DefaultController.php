<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Smalot\PdfParser\Object;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $fileName = "Addison.pdf";
        $filePath = $this->get('kernel')->getRootDir() . "\\..\\web\\uploads\\" . $fileName;

        $file = $this->get('file_locator')->locate($filePath);

        $q = $this->get('kreatys.pdf_parser')->parseFile($filePath)->getObjects();

        $e = [];
        /** @var Object $w */
        foreach ($q as $w) {
            if ($w->getContent() !== "") {
                $e[] = $w;
            }
        }

        dump($e);exit;

    }
}
