<?php

namespace NotationBundle\Controller;

use NotationBundle\Entity\personne;
use NotationBundle\Entity\Session;
use NotationBundle\Entity\Etudiant;
use NotationBundle\NotationBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Tests\RequestContentProxy;
use Symfony\Component\HttpFoundation\Tests\RequestTest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('NotationBundle:Default:index.html.twig');
    }
    //route qui redirige vers la page d'ajout de personne
    /**
     * @Route("/personne/ajout",name = "ajout_personne")
     */
    public function ajoutAction(Request $request)
    {
        //creation d'un objet personne et le formulaire d'ajout
        $personne = new personne();
        $form = $this->createFormBuilder($personne)
        ->add('nom','text')
        ->add('prenom','text')
        ->add('save','submit', array('label' => 'ajouter une personne'))
        ->getForm();

        //sauvegarder les informations du formulaire
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();
            return $this->redirectToRoute('ajout_personne');
        }

        //afficher la liste des personnes de la base
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('NotationBundle:personne')
            ->findAll();

        return $this->render('NotationBundle:Default:ajout.html.twig',
            array(
                'form'=> $form -> createView(),
                'liste' => $liste,
            )
        );

    }

    /**
     * @Route("/session/{id}/detail",name = "detail_session")
     * @ParamConverter("session", class="NotationBundle:Session")
     */

    public function detailSessionAction(Request $request, Session $session){

    }
    


}
