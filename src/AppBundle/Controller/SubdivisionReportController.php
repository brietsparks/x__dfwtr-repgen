<?php

namespace AppBundle\Controller;

use \DateTime;
use AppBundle\Entity\City;
use AppBundle\Entity\Subdivision;
use AppBundle\Form\SubdivisionReportImportType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;

use AppBundle\Entity\SubdivisionReport;

/**
 * SubdivisionReport controller.
 *
 * @Security("has_role('ROLE_USER')")
 * @Route("/subdivisionreport")
 */
class SubdivisionReportController extends Controller
{
    /**
     * Lists all SubdivisionReport entities.
     *
     * @Route("/", name="subdivisionreport")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:SubdivisionReport')->createQueryBuilder('e');
        
        list($filterForm, $queryBuilder) = $this->filter($queryBuilder, $request);
        list($subdivisionReports, $pagerHtml) = $this->paginator($queryBuilder, $request);
        
        return $this->render('subdivisionreport/index.html.twig', array(
            'subdivisionReports' => $subdivisionReports,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),

        ));
    }

    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter($queryBuilder, Request $request)
    {
        $session = $request->getSession();
        $filterForm = $this->createForm('AppBundle\Form\SubdivisionReportFilterType');

        // Reset filter
        if ($request->get('filter_action') == 'reset') {
            $session->remove('SubdivisionReportControllerFilter');
        }

        // Filter action
        if ($request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->handleRequest($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('SubdivisionReportControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('SubdivisionReportControllerFilter')) {
                $filterData = $session->get('SubdivisionReportControllerFilter');
                
                foreach ($filterData as $key => $filter) { //fix for entityFilterType that is loaded from session
                    if (is_object($filter)) {
                        $filterData[$key] = $queryBuilder->getEntityManager()->merge($filter);
                    }
                }
                
                $filterForm = $this->createForm('AppBundle\Form\SubdivisionReportFilterType', $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }

        return array($filterForm, $queryBuilder);
    }


    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder, Request $request)
    {
        //sorting
        $sortCol = $queryBuilder->getRootAlias().'.'.$request->get('pcg_sort_col', 'id');
        $queryBuilder->orderBy($sortCol, $request->get('pcg_sort_order', 'desc'));
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage($request->get('pcg_show' , 10));

        try {
            $pagerfanta->setCurrentPage($request->get('pcg_page', 1));
        } catch (\Pagerfanta\Exception\OutOfRangeCurrentPageException $ex) {
            $pagerfanta->setCurrentPage(1);
        }
        
        $entities = $pagerfanta->getCurrentPageResults();

        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me, $request)
        {
            $requestParams = $request->query->all();
            $requestParams['pcg_page'] = $page;
            return $me->generateUrl('subdivisionreport', $requestParams);
        };

        // Paginator - view
        $view = new TwitterBootstrap3View();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => 'previous',
            'next_message' => 'next',
        ));

        return array($entities, $pagerHtml);
    }
    
    

    /**
     * Displays a form to create a new SubdivisionReport entity.
     *
     * @Route("/new", name="subdivisionreport_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
    
        $subdivisionReport = new SubdivisionReport();
        $form   = $this->createForm('AppBundle\Form\SubdivisionReportType', $subdivisionReport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subdivisionReport);
            $em->flush();
            
            $editLink = $this->generateUrl('subdivisionreport_edit', array('id' => $subdivisionReport->getId()));
            $this->get('session')->getFlashBag()->add('success', "<a href='$editLink'>New subdivisionReport was created successfully.</a>" );
            
            $nextAction=  $request->get('submit') == 'save' ? 'subdivisionreport' : 'subdivisionreport_new';
            return $this->redirectToRoute($nextAction);
        }
        return $this->render('subdivisionreport/new.html.twig', array(
            'subdivisionReport' => $subdivisionReport,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Route("/import", name="subdivisionreport_import")
     * @Method({"GET", "POST"})
     */
    public function importAction(Request $request)
    {
        $form = $this->createForm(SubdivisionReportImportType::class)->add('Upload', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $importer = $this->get('app.subdivision_report.importer');

            $results = $importer->import($form->get('upload')->getData());

            return $this->render('subdivisionreport/import_results.html.twig', [
                'results' => $results
            ]);
        }

        return $this->render('subdivisionreport/import.html.twig', array(
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Route("export/{cityName}/{subdivisionName}/{endMonth}/{endDay}/{endYear}", name="subdivisionreport_export")
     */
    public function exportAction($cityName, $subdivisionName, $endMonth, $endDay, $endYear)
    {
        $cityRepo = $this->getDoctrine()->getRepository(City::class);
        $subdivRepo = $this->getDoctrine()->getRepository(Subdivision::class);
        $reportRepo = $this->getDoctrine()->getRepository(SubdivisionReport::class);

        /** @var City $city */
        $city = $cityRepo->findOneByName($cityName);

        /** @var Subdivision $subdivision */
        $subdivision = $subdivRepo->findOneBy([
            'name' => $subdivisionName,
            'city' => $city
        ]);

        $endDate = new DateTime("$endMonth/$endDay/$endYear");

        $report = $reportRepo->findOneBy([
            'subdivision' => $subdivision,
            'end' => $endDate
        ]);


        dump($report);exit;

        $homeValues = $this->get('exporter.home_values')->generate($report);
        $activeRain = $this->get('exporter.active_rain')->generate($report);
        $teamRealty = $this->get('exporter.team_realty')->generate($report);

        $article = ""
            . "*** HOME VALUES *** \r\n" . $homeValues . "\r\n"
            . "*** ACTIVE RAIN *** \r\n" . $activeRain . "\r\n"
            . "*** TEAM REALTY *** \r\n" . $teamRealty . "\r\n"
        ;

        $response = new Response();

        $response->setContent($article);
        $response->setStatusCode(Response::HTTP_OK);

        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }
    

    /**
     * Finds and displays a SubdivisionReport entity.
     *
     * @Route("/{id}", name="subdivisionreport_show")
     * @Method("GET")
     */
    public function showAction(SubdivisionReport $subdivisionReport)
    {
        $deleteForm = $this->createDeleteForm($subdivisionReport);
        return $this->render('subdivisionreport/show.html.twig', array(
            'subdivisionReport' => $subdivisionReport,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Displays a form to edit an existing SubdivisionReport entity.
     *
     * @Route("/{id}/edit", name="subdivisionreport_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SubdivisionReport $subdivisionReport)
    {
        $deleteForm = $this->createDeleteForm($subdivisionReport);
        $editForm = $this->createForm('AppBundle\Form\SubdivisionReportType', $subdivisionReport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subdivisionReport);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'Edited Successfully!');
            return $this->redirectToRoute('subdivisionreport_edit', array('id' => $subdivisionReport->getId()));
        }
        return $this->render('subdivisionreport/edit.html.twig', array(
            'subdivisionReport' => $subdivisionReport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Deletes a SubdivisionReport entity.
     *
     * @Route("/{id}", name="subdivisionreport_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SubdivisionReport $subdivisionReport)
    {
    
        $form = $this->createDeleteForm($subdivisionReport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subdivisionReport);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The SubdivisionReport was deleted successfully');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the SubdivisionReport');
        }
        
        return $this->redirectToRoute('subdivisionreport');
    }
    
    /**
     * Creates a form to delete a SubdivisionReport entity.
     *
     * @param SubdivisionReport $subdivisionReport The SubdivisionReport entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SubdivisionReport $subdivisionReport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subdivisionreport_delete', array('id' => $subdivisionReport->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Delete SubdivisionReport by id
     *
     * @Route("/delete/{id}", name="subdivisionreport_by_id_delete")
     * @Method("GET")
     */
    public function deleteByIdAction(SubdivisionReport $subdivisionReport){
        $em = $this->getDoctrine()->getManager();
        
        try {
            $em->remove($subdivisionReport);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The SubdivisionReport was deleted successfully');
        } catch (Exception $ex) {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the SubdivisionReport');
        }

        return $this->redirect($this->generateUrl('subdivisionreport'));

    }
    

    /**
    * Bulk Action
    * @Route("/bulk-action/", name="subdivisionreport_bulk_action")
    * @Method("POST")
    */
    public function bulkAction(Request $request)
    {
        $ids = $request->get("ids", array());
        $action = $request->get("bulk_action", "delete");

        if ($action == "delete") {
            try {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('AppBundle:SubdivisionReport');

                foreach ($ids as $id) {
                    $subdivisionReport = $repository->find($id);
                    $em->remove($subdivisionReport);
                    $em->flush();
                }

                $this->get('session')->getFlashBag()->add('success', 'subdivisionReports was deleted successfully!');

            } catch (Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the subdivisionReports ');
            }
        }

        return $this->redirect($this->generateUrl('subdivisionreport'));
    }
    

}
