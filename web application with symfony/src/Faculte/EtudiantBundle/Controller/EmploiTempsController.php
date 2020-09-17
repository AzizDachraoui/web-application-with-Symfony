<?php

namespace Faculte\EtudiantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use Faculte\AdminBundle\Entity\EmploiTemps;
use Faculte\AdminBundle\Entity\Groupe;



class EmploiTempsController extends Controller
{
    public function indexAction()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
            return $this->render('FaculteEtudiantBundle:EmploiTemps:index.html.twig', array('Filieres' => $Filieres));

        }
    }

        public function groupesAction($idNiveau)
    {

        $em = $this->getDoctrine()->getManager();
        $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
        $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idNiveau);
        $groupes=$em->getRepository('FaculteAdminBundle:Groupe')->findBy(array('niveau'=>$niveau));
        $emploistemps=$em->getRepository('FaculteAdminBundle:EmploiTemps')->findBy(array('groupe'=>$groupes));
        return $this->render('FaculteEtudiantBundle:EmploiTemps:groupes.html.twig', array('Filieres' => $Filieres,
            'groupe' => $groupes,'niveau'=>$niveau ,'emploistemps'=>$emploistemps));


    }
}
