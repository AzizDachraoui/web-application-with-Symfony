<?php

namespace Faculte\AdminBundle\Controller;

use Faculte\AdminBundle\Entity\Galerie;
use Faculte\AdminBundle\Form\GalerieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GalerieController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('FaculteAdminBundle:Galerie:index.html.twig');

    }

    public function ajouterGalerieAction(Request $request)
    {
        $Galerie = new Galerie();
        $form = $this->createForm( GalerieType::class, $Galerie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            if ($request->getMethod() == 'POST') {
                $em = $this->getDoctrine()->getManager();
                $Galerie->upload();
                $Galerie = $form->getData();
                $em->persist($Galerie);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_admin_galerie'));
            }
        }

        return $this->render('FaculteAdminBundle:Galerie:ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
