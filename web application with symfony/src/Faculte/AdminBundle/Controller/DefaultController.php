<?php

namespace Faculte\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Enseignants = $em->getRepository('FaculteAdminBundle:Enseignant')->findAll();
        $Etudiants = $em->getRepository('FaculteAdminBundle:Etudiant')->findAll();
        $Groupes = $em->getRepository('FaculteAdminBundle:Groupe')->findAll();
        $Niveaux = $em->getRepository('FaculteAdminBundle:Niveau')->findAll();
        $Filieres = $em->getRepository('FaculteAdminBundle:Filiere')->findAll();
        $Matieres = $em->getRepository('FaculteAdminBundle:Filiere')->findAll();
        $Inscriptions = $em->getRepository('FaculteAdminBundle:Inscription')->findAll();

            return $this->render('FaculteAdminBundle:Default:index.html.twig',array('Enseignant'=>$Enseignants, 'Etudiant'=>$Etudiants, 'Groupe'=>$Groupes, 'Niveau'=>$Niveaux, 'Filiere'=>$Filieres , 'Matiere'=>$Matieres , 'Inscription'=>$Inscriptions));

    }
}
