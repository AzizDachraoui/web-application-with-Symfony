<?php

namespace Faculte\EtudiantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;



class ResultatController extends Controller
{
    public function indexAction()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
            return $this->render('FaculteEtudiantBundle:Resultat:index.html.twig', array('Filieres' => $Filieres));

        }
    }

        public function niveauxAction($idN)
    {

        $em = $this->getDoctrine()->getManager();
        $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
        $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idN);
        $resultats=$em->getRepository('FaculteAdminBundle:Resultat')->findBy(array('niveau'=>$niveau));
        return $this->render('FaculteEtudiantBundle:Resultat:niveaux.html.twig', array('Filieres' => $Filieres,
            'resultats' => $resultats,'niveau'=>$niveau));


    }
}
