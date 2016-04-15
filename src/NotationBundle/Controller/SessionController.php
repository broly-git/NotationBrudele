<?php

namespace NotationBundle\Controller;

use NotationBundle\Entity\personne;
use NotationBundle\Entity\Session;
use NotationBundle\Entity\Etudiant;
use NotationBundle\NotationBundle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Tests\RequestContentProxy;
use Symfony\Component\HttpFoundation\Tests\RequestTest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SessionController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('NotationBundle:Default:index.html.twig');
    }

    //route qui redirige vers la page d'ajout de sesion
    /**
     * @Route("/session/ajoutsession",name = "ajout_session")
     */
    public function ajoutsessionAction(Request $request)
    {
        //creation d'un objet session et le formulaire d'ajout
        $session = new Session();
        $form = $this->createFormBuilder($session)
            ->add('intitule','text')
            ->add('dateDebut','date')
            ->add('dateFin','date')
            ->add('Enseignant', EntityType::class, array(
                'class'=> 'NotationBundle\Entity\personne',
                'choice_label'=> 'nom',))
            ->add('Etudiant', EntityType::class, array(
                'class'=> 'NotationBundle\Entity\Etudiant',
                'multiple' => true,
                'choice_label'=> 'nom',))
            ->add('save','submit', array('label' => 'ajouter une session'))
            ->getForm();

        //sauvegarder les informations du formulaire
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();
            return $this->redirectToRoute('ajout_session');
        }

        //afficher la liste des sessions de la base
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('NotationBundle:Session')
            ->findAll();

        return $this->render('NotationBundle:Default:ajoutsession.html.twig',
            array(
                'form'=> $form -> createView(),
                'liste' => $liste,
            )
        );

    }



}
