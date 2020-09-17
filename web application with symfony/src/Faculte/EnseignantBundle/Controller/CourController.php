<?php
namespace Faculte\EnseignantBundle\Controller;


use Faculte\AdminBundle\Form\CourEditType;
use Faculte\AdminBundle\Form\CourFileEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Cour;
use Faculte\AdminBundle\Form\CourType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class CourController extends controller
{
    public function ajouterCourAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cour = new Cour();
        $form = $this->createForm(CourType::class, $cour);
        $form->handleRequest($request);
        $user = $this->getUser();
        $enseignant = $em->getRepository('FaculteAdminBundle:Enseignant')->findOneBy(array('user' => $user));
        if (!empty($enseignant)) {
            if ($form->isValid()) {
                $cour->setEnseignant($enseignant);
                $cour ->uploadPathFile();
                $em->persist($cour );
                $em->flush();
                $cour ->movePathFile();
                return $this->redirect($this->generateUrl('faculte_enseignant_cours'));
            }
        }
        return $this->render('FaculteEnseignantBundle:Cour:ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function modifierCourAction($idC, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $cour=$em->getRepository('FaculteAdminBundle:Cour')->findOneById($idC);
        $form = $this->createForm(CourEditType::class, $cour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($cour);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_enseignant_cours'));
            }

        return $this->render('FaculteEnseignantBundle:Cour:modifier.html.twig', array(
            'form' => $form->createView(),'cours'=>$cour
        ));
    }

    public function supprimerCourAction($idC, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cour = $em->getRepository('FaculteAdminBundle:Cour')->findOneById($idC);
        $em->remove($cour);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_enseignant_cours'));


    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $enseignant = $em->getRepository('FaculteAdminBundle:Enseignant')->findOneBy(array('user' => $user));
        $Cours = $em->getRepository('FaculteAdminBundle:Cour')->findBy(array('enseignant' => $enseignant));
        return $this->render('FaculteEnseignantBundle:Cour:index.html.twig', array('Cours' => $Cours));

    }



    public function modifierFileCourAction($idC, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $cour=$em->getRepository('FaculteAdminBundle:Cour')->findOneById($idC);
        $form = $this->createForm(CourFileEditType::class, $cour);
        $form->handleRequest($request);
         if ($form->isValid()) {
             $cour->uploadPathFile();
             $em->persist($cour);
             $em->flush();
             return $this->redirect($this->generateUrl('faculte_enseignant_cours'));
         }
        return $this->render('FaculteEnseignantBundle:Cour:modifierEdit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function renderNiveauAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idFiliere = $request->request->get('idfiliere');
        $filiere = $em->getRepository('FaculteAdminBundle:Filiere')->find($idFiliere);
        $niveaux = $em->getRepository('FaculteAdminBundle:Niveau')->findBy(array('filiere' => $filiere));


        $idCour = $request->request->get('idCour');
        $cours = null;
        if(!empty($idCour)){
            $cours = $em->getRepository('FaculteAdminBundle:Cour')->find($idCour);
        }


        return $this->render('FaculteEnseignantBundle:Cour:renderNiveau.html.twig', array('niveaux' => $niveaux ,'cours'=>$cours));
    }


    public function renderMatieresAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idNiveaux = $request->request->get('idNiveaux');
        $niveaux = null;
        foreach ($idNiveaux as $idNiveau) {
            $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idNiveau);
            $niveaux[] = $niveau;
        }
        $user = $this->getUser();
        $enseignant = $em->getRepository('FaculteAdminBundle:Enseignant')->findOneBy(array('user' => $user));
        $Enseignantmatieres = $enseignant->getMatieres();
        $matieres = null;
        if (!empty($Enseignantmatieres)) {
            foreach ($Enseignantmatieres as $Enseignantmatiere) {
                /**@var \Faculte\AdminBundle\Entity\Matiere $Enseignantmatiere * */
                foreach ($Enseignantmatiere->getNiveaux() as $niveauMatiereEns) {
                    foreach ($niveaux as $niveau) {
                        if ($niveau->getId() == $niveauMatiereEns->getId()) {
                            $matieres[] = $Enseignantmatiere;
                        }
                    }
                }
            }
        }

        $idCour = $request->request->get('idCour');
        $cours = null;
        if(!empty($idCour)){
            $cours = $em->getRepository('FaculteAdminBundle:Cour')->find($idCour);
        }

        return $this->render('FaculteEnseignantBundle:Cour:renderMatieres.html.twig',array('matieres'=>$matieres,'niveaux'=>$niveaux ,'cours'=>$cours ,'enseignant'=>$enseignant));
    }





}