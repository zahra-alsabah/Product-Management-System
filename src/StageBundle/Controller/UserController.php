<?php

namespace StageBundle\Controller;


use StageBundle\Entity\User;
use StageBundle\Form\UserType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function ajoutUserAction(Request $request)
    {
      $User = new User();
      $form = $this->createForm(UserType::class,$User);
      $form-> handleRequest($request);

      if($form->isSubmitted()){
          $em= $this->getDoctrine()->getManager() ;
          $em->persist($User);
          $em->flush();
          return $this->redirectToRoute('Stage_afficheUser');
      }

      return $this ->render('@Stage\User\ajoutU.html.twig',array('form'=>$form->createView()));


    }

    public function afficheUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $User = $em->getRepository("StageBundle:User")->findAll();
        return $this ->render('@Stage\User\afficheU.html.twig',array('User'=>$User));


    }

    public function SupprimerUserAction(Request $request, $id)
    {
        $User = new User();
        $em = $this->getDoctrine()->getManager();
        $User = $em->getRepository("StageBundle:User")->find($id);
        $em->remove($User);
        $em->flush();
        return $this->redirectToRoute('Stage_afficheUser');

    }

    public function affichageAction ()
    {
        return $this ->render('@Stage\User\affichage.html.twig');
    }

}
