<?php
namespace Faculte\EtudiantBundle\Controller;



use Faculte\AdminBundle\Entity\Groupe;
use Faculte\AdminBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\AbsenceEtd;
use Faculte\AdminBundle\Form\AbsenceEtdType;
use Symfony\Component\HttpFoundation\Request;


class EmailEnseignantController extends controller
{

    public function listeEmailEnseignantsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $enseignants=$em->getRepository('FaculteAdminBundle:Enseignant')->findAll();
        return $this->render('FaculteEtudiantBundle:EmailEnseignant:listeEmailEnseignants.html.twig',
            array('enseignants' => $enseignants ));


    }

}