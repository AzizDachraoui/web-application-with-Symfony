<?php
namespace Faculte\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Filiere;
use Faculte\AdminBundle\Form\FiliereType;
use Symfony\Component\HttpFoundation\Request;

class FiliereController extends controller
{
    public function ajouterFiliereAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Filiere = new Filiere();
        $form = $this->createForm( FiliereType::class, $Filiere);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            if ($request->getMethod() == 'POST') {
                $Filiere = $form->getData();
                $em->persist($Filiere);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_admin_filieres'));
            }
        }

        return $this->render('FaculteAdminBundle:Filiere:ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function modifierFiliereAction($idF,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Filiere=$em->getRepository('FaculteAdminBundle:Filiere')->findOneById($idF);
        $form = $this->createForm(FiliereType::class, $Filiere);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->isMethod('POST')) {
                $Filiere = $form->getData();
                $em->persist($Filiere);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_admin_filieres'));
            }
        }

        return $this->render('FaculteAdminBundle:Filiere:modifier.html.twig', array(
            'form' => $form->createView(),'Filiere'=>$Filiere));

    }


    public function supprimerFiliereAction($idF,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Filiere=$em->getRepository('FaculteAdminBundle:Filiere')->findOneById($idF);
        $em->remove($Filiere);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_filieres'));


    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
        return $this->render('FaculteAdminBundle:Filiere:index.html.twig',array('Filieres'=>$Filieres));

    }












}