<?php

namespace StageBundle\Controller;

use StageBundle\Entity\indexe;
use StageBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use StageBundle\Form\indexeType;

/**
 * Indexe controller.
 *
 * @Route("indexe")
 */
class indexeController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $indexes = $em->getRepository('StageBundle:indexe')->findAll();

        return $this->render('@Stage/indexe/index.html.twig', array(
            'indexes' => $indexes,
        ));
    }
    public function deleteIndexeAction(Request $request, $id)
    {
        $indexe = new indexe();
        $em = $this->getDoctrine()->getManager();
        $indexe = $em->getRepository("StageBundle:indexe")->find($id);
        $em->remove($indexe);
        $em->flush();
        return $this->redirectToRoute('indexe_index');

    }


    /**
     * Creates a new indexe entity.
     *
     * @Route("/new", name="indexe_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $indexe = new Indexe();
        $form = $this->createForm(indexeType::class,$indexe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $description = $indexe->getDescription();
            $em= $this->getDoctrine()->getManager();
            $array_Product = $em->getRepository( Product::class)->findByDescription($description);
        if($array_Product!=null) {
        $one_Product_object= $array_Product[0] ;
        $indexe->setProduct($one_Product_object);
        $em->persist($indexe);
        $em->flush();

            return $this->redirectToRoute('indexe_show', array('id' => $indexe->getId()));
        }}

        return $this->render('@Stage\indexe\new.html.twig', array(
            'indexe' => $indexe,
            'form' => $form->createView(),
        ));
    }


    public function showAction(indexe $indexe)
    {
        $deleteForm = $this->createDeleteForm($indexe);

        return $this->render('@Stage/indexe/show.html.twig', array(
            'indexe' => $indexe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing indexe entity.
     *
     * @Route("/{id}/edit", name="indexe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, indexe $indexe)
    {
        $deleteForm = $this->createDeleteForm($indexe);
        $editForm = $this->createForm('StageBundle\Form\indexeType', $indexe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('indexe_edit', array('id' => $indexe->getId()));
        }

        return $this->render('@Stage/indexe/edit.html.twig', array(
            'indexe' => $indexe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a indexe entity.
     *
     * @Route("/{id}", name="indexe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, indexe $indexe)
    {
        $form = $this->createDeleteForm($indexe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($indexe);
            $em->flush();
        }

        return $this->redirectToRoute('indexe_index');
    }

    /**
     * Creates a form to delete a indexe entity.
     *
     * @param indexe $indexe The indexe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(indexe $indexe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('indexe_delete', array('id' => $indexe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function AfficheProductAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('StageBundle:Product')->findAll();

        return $this->render('@stage/product/index.html.twig', array(
            'products' => $products,
        ));
    }
}
