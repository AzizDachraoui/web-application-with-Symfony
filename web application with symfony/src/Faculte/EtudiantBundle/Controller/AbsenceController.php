<?php
namespace Faculte\EtudiantBundle\Controller;



use Faculte\AdminBundle\Entity\Groupe;
use Faculte\AdminBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\AbsenceEtd;
use Faculte\AdminBundle\Form\AbsenceEtdType;
use Symfony\Component\HttpFoundation\Request;


class AbsenceController extends controller
{


    public function FilieresAction()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
            return $this->render('FaculteEtudiantBundle:Absence:Filieres.html.twig', array('Filieres' => $Filieres));

        }
    }


    public function groupeAction($idNiveau)
    {

        $em = $this->getDoctrine()->getManager();
        $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
        $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idNiveau);
        $groupes=$em->getRepository('FaculteAdminBundle:Groupe')->findBy(array('niveau'=>$niveau));
        return $this->render('FaculteEtudiantBundle:Absence:groupes.html.twig', array('Filieres' => $Filieres,
            'groupes' => $groupes,'niveau'=>$niveau ));


    }
    public function indexAction($idGroupe)
    {
        $em = $this->getDoctrine()->getManager();
        /**@var Groupe $groupe */
        $groupe = $em->getRepository('FaculteAdminBundle:Groupe')->find($idGroupe);

        $matieres = $groupe->getNiveau()->getMatieres();

        $user = $this->getUser();
        $etudiant = $em->getRepository('FaculteAdminBundle:Etudiant')->findOneBy(array('user' => $user));

        $absences = $em->getRepository('FaculteAdminBundle:AbsenceEtd')->findBy(array('etudiant'=>$etudiant));
        return $this->render('FaculteEtudiantBundle:Absence:index.html.twig', array('groupe' => $groupe,
           'matieres' => $matieres, 'etudiant' => $etudiant,"absences"=>$absences));


    }

}