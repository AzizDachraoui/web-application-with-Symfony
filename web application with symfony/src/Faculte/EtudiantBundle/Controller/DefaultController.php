<?php

namespace Faculte\EtudiantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;



class DefaultController extends Controller
{
    public function indexAction()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
            return $this->render('FaculteEtudiantBundle:Default:index.html.twig', array('Filieres' => $Filieres));

        }
    }

    public function coursAction($idMatiere)
    {
        $em = $this->getDoctrine()->getManager();
        $matiere=$em->getRepository('FaculteAdminBundle:Matiere')->find($idMatiere);
        $cours = $em->getRepository('FaculteAdminBundle:Cour')->findBy(array('matiere'=>$matiere));
        return $this->render('FaculteEtudiantBundle:Default:cours.html.twig', array('cours' => $cours));
    }

    public function matieresAction($idNiveau)
    {

        $em = $this->getDoctrine()->getManager();
        $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
        $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idNiveau);
        $matiere=$em->getRepository('FaculteAdminBundle:Matiere')->findAll();
        return $this->render('FaculteEtudiantBundle:Default:matieres.html.twig', array('Filieres' => $Filieres,
            'matiere' => $matiere,'niveau'=>$niveau));


    }
}
