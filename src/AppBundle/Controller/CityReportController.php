<?php

namespace AppBundle\Controller;

use AppBundle\Form\CityReportImportType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;

use AppBundle\Entity\CityReport;

/**
 * CityReport controller.
 *
 * @Route("/cityreport")
 */
class CityReportController extends Controller
{
    /**
     * Lists all CityReport entities.
     *
     * @Route("/", name="cityreport")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:CityReport')->createQueryBuilder('e');
        
        list($filterForm, $queryBuilder) = $this->filter($queryBuilder, $request);
        list($cityReports, $pagerHtml) = $this->paginator($queryBuilder, $request);
        
        return $this->render('cityreport/index.html.twig', array(
            'cityReports' => $cityReports,
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
        $filterForm = $this->createForm('AppBundle\Form\CityReportFilterType');

        // Reset filter
        if ($request->get('filter_action') == 'reset') {
            $session->remove('CityReportControllerFilter');
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
                $session->set('CityReportControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('CityReportControllerFilter')) {
                $filterData = $session->get('CityReportControllerFilter');
                
                foreach ($filterData as $key => $filter) { //fix for entityFilterType that is loaded from session
                    if (is_object($filter)) {
                        $filterData[$key] = $queryBuilder->getEntityManager()->merge($filter);
                    }
                }
                
                $filterForm = $this->createForm('AppBundle\Form\CityReportFilterType', $filterData);
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
            return $me->generateUrl('cityreport', $requestParams);
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
     * Displays a form to create a new CityReport entity.
     *
     * @Route("/new", name="cityreport_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
    
        $cityReport = new CityReport();
        $form   = $this->createForm('AppBundle\Form\CityReportType', $cityReport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cityReport);
            $em->flush();
            
            $editLink = $this->generateUrl('cityreport_edit', array('id' => $cityReport->getId()));
            $this->get('session')->getFlashBag()->add('success', "<a href='$editLink'>New cityReport was created successfully.</a>" );
            
            $nextAction=  $request->get('submit') == 'save' ? 'cityreport' : 'cityreport_new';
            return $this->redirectToRoute($nextAction);
        }
        return $this->render('cityreport/new.html.twig', array(
            'cityReport' => $cityReport,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Route("/import", name="cityreport_import")
     * @Method({"GET", "POST"})
     */
    public function importAction(Request $request)
    {
        $form = $this->createForm(CityReportImportType::class)->add('Upload', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $importer = $this->get('app.city_report.importer');

            $results = $importer->import($form->get('upload')->getData());

            return $this->render('cityreport/import_results.html.twig', [
                'results' => $results
            ]);
//            $request->request->add(['results' => $results]);
//
//            return $this->redirectToRoute('cityreport_import_results', [
//                'results' => $results
//            ], 307);
        }

        return $this->render('cityreport/import.html.twig', array(
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Route("/import/results", name="cityreport_import_results")
     */
    public function importResultsAction(Request $request)
    {
        $results = $request->query->get('results');

        return $this->render('cityreport/import_results.html.twig', array(
            'results' => $results
        ));
    }
    

    /**
     * Finds and displays a CityReport entity.
     *
     * @Route("/{id}", name="cityreport_show")
     * @Method("GET")
     */
    public function showAction(CityReport $cityReport)
    {
        $deleteForm = $this->createDeleteForm($cityReport);
        return $this->render('cityreport/show.html.twig', array(
            'cityReport' => $cityReport,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Displays a form to edit an existing CityReport entity.
     *
     * @Route("/{id}/edit", name="cityreport_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CityReport $cityReport)
    {
        $deleteForm = $this->createDeleteForm($cityReport);
        $editForm = $this->createForm('AppBundle\Form\CityReportType', $cityReport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cityReport);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'Edited Successfully!');
            return $this->redirectToRoute('cityreport_edit', array('id' => $cityReport->getId()));
        }
        return $this->render('cityreport/edit.html.twig', array(
            'cityReport' => $cityReport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Deletes a CityReport entity.
     *
     * @Route("/{id}", name="cityreport_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CityReport $cityReport)
    {
    
        $form = $this->createDeleteForm($cityReport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cityReport);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The CityReport was deleted successfully');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the CityReport');
        }
        
        return $this->redirectToRoute('cityreport');
    }
    
    /**
     * Creates a form to delete a CityReport entity.
     *
     * @param CityReport $cityReport The CityReport entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CityReport $cityReport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cityreport_delete', array('id' => $cityReport->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Delete CityReport by id
     *
     * @Route("/delete/{id}", name="cityreport_by_id_delete")
     * @Method("GET")
     */
    public function deleteByIdAction(CityReport $cityReport){
        $em = $this->getDoctrine()->getManager();
        
        try {
            $em->remove($cityReport);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The CityReport was deleted successfully');
        } catch (Exception $ex) {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the CityReport');
        }

        return $this->redirect($this->generateUrl('cityreport'));

    }
    

    /**
    * Bulk Action
    * @Route("/bulk-action/", name="cityreport_bulk_action")
    * @Method("POST")
    */
    public function bulkAction(Request $request)
    {
        $ids = $request->get("ids", array());
        $action = $request->get("bulk_action", "delete");

        if ($action == "delete") {
            try {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('AppBundle:CityReport');

                foreach ($ids as $id) {
                    $cityReport = $repository->find($id);
                    $em->remove($cityReport);
                    $em->flush();
                }

                $this->get('session')->getFlashBag()->add('success', 'cityReports was deleted successfully!');

            } catch (Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the cityReports ');
            }
        }

        return $this->redirect($this->generateUrl('cityreport'));
    }
    

}
