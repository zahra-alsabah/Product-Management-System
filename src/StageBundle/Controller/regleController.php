<?php

namespace StageBundle\Controller;

use StageBundle\Entity\regle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Regle controller.
 *
 * @Route("regle")
 */
class regleController extends Controller
{
    /**
     * Lists all regle entities.
     *
     * @Route("/", name="regle_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $regles = $em->getRepository('StageBundle:regle')->findAll();

        return $this->render('@Stage\regle\index.html.twig', array(
            'regles' => $regles,
        ));
    }

    /**
     * Creates a new regle entity.
     *
     * @Route("/new", name="regle_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $regle = new Regle();
        $form = $this->createForm('StageBundle\Form\regleType', $regle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($regle);
            $em->flush();

            return $this->redirectToRoute('regle_show', array('id' => $regle->getId()));
        }

        return $this->render('@Stage\regle\new.html.twig', array(
            'regle' => $regle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a regle entity.
     *
     * @Route("/{id}", name="regle_show")
     * @Method("GET")
     */
    public function showAction(regle $regle)
    {
        $deleteForm = $this->createDeleteForm($regle);

        return $this->render('@Stage\regle\show.html.twig', array(
            'regle' => $regle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing regle entity.
     *
     * @Route("/{id}/edit", name="regle_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, regle $regle)
    {
        $deleteForm = $this->createDeleteForm($regle);
        $editForm = $this->createForm('StageBundle\Form\regleType', $regle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('regle_edit', array('id' => $regle->getId()));
        }

        return $this->render('@Stage\regle\edit.html.twig', array(
            'regle' => $regle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a regle entity.
     *
     * @Route("/{id}", name="regle_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, regle $regle)
    {
        $form = $this->createDeleteForm($regle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($regle);
            $em->flush();
        }

        return $this->redirectToRoute('regle_index');
    }

    /**
     * Creates a form to delete a regle entity.
     *
     * @param regle $regle The regle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(regle $regle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('regle_delete', array('id' => $regle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
