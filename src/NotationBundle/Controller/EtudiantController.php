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

class EtudiantController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('NotationBundle:Default:index.html.twig');
    }
    //route qui redirige vers la page d'ajout d'étudiant
    /**
     * @Route("/etudiant/ajoutetudiant",name = "ajout_etudiant")
     */
    public function ajoutAction(Request $request)
    {
        //creation d'un objet personne et le formulaire d'ajout
        $etudiant = new Etudiant();
        $form = $this->createFormBuilder($etudiant)
            ->add('nom','text')
            ->add('save','submit', array('label' => 'ajouter un etudiant'))
            ->getForm();

        //sauvegarder les informations du formulaire
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();
            return $this->redirectToRoute('ajout_etudiant');
        }

        //afficher la liste des etudiants de la base
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('NotationBundle:Etudiant')
            ->findAll();

        return $this->render('NotationBundle:Default:ajoutetudiant.html.twig',
            array(
                'form'=> $form -> createView(),
                'liste' => $liste,
            )
        );

    }

}
