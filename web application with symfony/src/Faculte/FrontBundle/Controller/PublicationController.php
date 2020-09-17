<?php

namespace Faculte\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Publier;
use Faculte\AdminBundle\Entity\Filiere;
use Doctrine\ORM\EntityRepository;




class PublicationController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $publiers=$em->getRepository('FaculteAdminBundle:Publier')->findAll();
        return $this->render('FaculteFrontBundle:Default:index.html.twig', array('publiers'=>$publiers));
    }
    public function publierAction($idPublier)
    {
           $em = $this->getDoctrine()->getManager();
           $publiers=$em->getRepository('FaculteAdminBundle:Publier')->findOneById($idPublier);
           return $this->render('FaculteFrontBundle:Inscription:publication.html.twig', array('publiers'=>$publiers));

    }
}
