<?php

namespace Faculte\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FaculteFrontBundle:Default:index.html.twig');
    }

    public function gallerieAction()
    {
        return $this->render('FaculteFrontBundle:Default:Galerie.html.twig');
    }

    public function contactAction()
    {
        return $this->render('FaculteFrontBundle:Default:contact.html.twig');
    }
    public function bourseAction()
    {
        return $this->render('FaculteFrontBundle:Default:bourse.html.twig');
    }
    public function environnementAction()
    {
        return $this->render('FaculteFrontBundle:Default:environnement.html.twig');
    }
    public function reglementAction()
    {
        return $this->render('FaculteFrontBundle:Default:reglement.html.twig');
    }
    public function calendriesAction()
    {
        return $this->render('FaculteFrontBundle:Default:calendries.html.twig');
    }
    public function activiteAction()
    {
        return $this->render('FaculteFrontBundle:Default:activite.html.twig');
    }

    public function LAEABFAction()
    {
        return $this->render('FaculteFrontBundle:Default:LAEABF.html.twig');
    }
    public function LFEMFBAction()
    {
        return $this->render('FaculteFrontBundle:Default:LFEMFB.html.twig');
    }
    public function LAGCAction()
    {
        return $this->render('FaculteFrontBundle:Default:LAGC.html.twig');
    }
    public function LAGGRHAction()
    {
        return $this->render('FaculteFrontBundle:Default:LAGGRH.html.twig');
    }
    public function LFGMAction()
    {
        return $this->render('FaculteFrontBundle:Default:LFGM.html.twig');
    }
    public function LAIAGAction()
    {
        return $this->render('FaculteFrontBundle:Default:LAIAG.html.twig');
    }
    public function LFIAGAction()
    {
        return $this->render('FaculteFrontBundle:Default:LFIAG.html.twig');
    }
    public function presentationAction()
    {
        return $this->render('FaculteFrontBundle:Default:presentation.html.twig');
    }
    public function organigrammeAction()
    {
        return $this->render('FaculteFrontBundle:Default:organigramme.html.twig');
    }
    public function officielAction()
    {
        return $this->render('FaculteFrontBundle:Default:officiel.html.twig');
    }
    public function chiffreAction()
    {
        return $this->render('FaculteFrontBundle:Default:chiffre.html.twig');
    }
    public function infrastructureAction()
    {
        return $this->render('FaculteFrontBundle:Default:infrastructure.html.twig');
    }
    public function observatoireAction()
    {
        return $this->render('FaculteFrontBundle:Default:observatoire.html.twig');
    }

    public function PageAccueilAction()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $publiers=$em->getRepository('FaculteAdminBundle:Publier')->findAll();
            return $this->render('FaculteFrontBundle:Default:PageAccueil.html.twig', array('publiers'=>$publiers));

        }
    }



}

