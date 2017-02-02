<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;

use AppBundle\Entity\Subdivision;

/**
 * Subdivision controller.
 *
 * @Security("has_role('ROLE_USER')")
 * @Route("/subdivision")
 */
class SubdivisionController extends Controller
{
    /**
     * Lists all Subdivision entities.
     *
     * @Route("/", name="subdivision")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Subdivision')->createQueryBuilder('e');
        
        list($filterForm, $queryBuilder) = $this->filter($queryBuilder, $request);
        list($subdivisions, $pagerHtml) = $this->paginator($queryBuilder, $request);
        
        return $this->render('subdivision/index.html.twig', array(
            'subdivisions' => $subdivisions,
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
        $filterForm = $this->createForm('AppBundle\Form\SubdivisionFilterType');

        // Reset filter
        if ($request->get('filter_action') == 'reset') {
            $session->remove('SubdivisionControllerFilter');
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
                $session->set('SubdivisionControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('SubdivisionControllerFilter')) {
                $filterData = $session->get('SubdivisionControllerFilter');
                
                foreach ($filterData as $key => $filter) { //fix for entityFilterType that is loaded from session
                    if (is_object($filter)) {
                        $filterData[$key] = $queryBuilder->getEntityManager()->merge($filter);
                    }
                }
                
                $filterForm = $this->createForm('AppBundle\Form\SubdivisionFilterType', $filterData);
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
            return $me->generateUrl('subdivision', $requestParams);
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
     * Displays a form to create a new Subdivision entity.
     *
     * @Route("/new", name="subdivision_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
    
        $subdivision = new Subdivision();
        $form   = $this->createForm('AppBundle\Form\SubdivisionType', $subdivision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subdivision);
            $em->flush();
            
            $editLink = $this->generateUrl('subdivision_edit', array('id' => $subdivision->getId()));
            $this->get('session')->getFlashBag()->add('success', "<a href='$editLink'>New subdivision was created successfully.</a>" );
            
            $nextAction=  $request->get('submit') == 'save' ? 'subdivision' : 'subdivision_new';
            return $this->redirectToRoute($nextAction);
        }
        return $this->render('subdivision/new.html.twig', array(
            'subdivision' => $subdivision,
            'form'   => $form->createView(),
        ));
    }
    

    /**
     * Finds and displays a Subdivision entity.
     *
     * @Route("/{id}", name="subdivision_show")
     * @Method("GET")
     */
    public function showAction(Subdivision $subdivision)
    {
        $deleteForm = $this->createDeleteForm($subdivision);
        return $this->render('subdivision/show.html.twig', array(
            'subdivision' => $subdivision,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Displays a form to edit an existing Subdivision entity.
     *
     * @Route("/{id}/edit", name="subdivision_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Subdivision $subdivision)
    {
        $deleteForm = $this->createDeleteForm($subdivision);
        $editForm = $this->createForm('AppBundle\Form\SubdivisionType', $subdivision);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subdivision);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'Edited Successfully!');
            return $this->redirectToRoute('subdivision_edit', array('id' => $subdivision->getId()));
        }
        return $this->render('subdivision/edit.html.twig', array(
            'subdivision' => $subdivision,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Deletes a Subdivision entity.
     *
     * @Route("/{id}", name="subdivision_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Subdivision $subdivision)
    {
    
        $form = $this->createDeleteForm($subdivision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subdivision);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The Subdivision was deleted successfully');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the Subdivision');
        }
        
        return $this->redirectToRoute('subdivision');
    }
    
    /**
     * Creates a form to delete a Subdivision entity.
     *
     * @param Subdivision $subdivision The Subdivision entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Subdivision $subdivision)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subdivision_delete', array('id' => $subdivision->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Delete Subdivision by id
     *
     * @Route("/delete/{id}", name="subdivision_by_id_delete")
     * @Method("GET")
     */
    public function deleteByIdAction(Subdivision $subdivision){
        $em = $this->getDoctrine()->getManager();
        
        try {
            $em->remove($subdivision);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The Subdivision was deleted successfully');
        } catch (Exception $ex) {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the Subdivision');
        }

        return $this->redirect($this->generateUrl('subdivision'));

    }
    

    /**
    * Bulk Action
    * @Route("/bulk-action/", name="subdivision_bulk_action")
    * @Method("POST")
    */
    public function bulkAction(Request $request)
    {
        $ids = $request->get("ids", array());
        $action = $request->get("bulk_action", "delete");

        if ($action == "delete") {
            try {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('AppBundle:Subdivision');

                foreach ($ids as $id) {
                    $subdivision = $repository->find($id);
                    $em->remove($subdivision);
                    $em->flush();
                }

                $this->get('session')->getFlashBag()->add('success', 'subdivisions was deleted successfully!');

            } catch (Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the subdivisions ');
            }
        }

        return $this->redirect($this->generateUrl('subdivision'));
    }
    

}
