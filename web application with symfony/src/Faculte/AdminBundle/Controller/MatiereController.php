<?php
namespace Faculte\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Matiere;
use Faculte\AdminBundle\Form\MatiereType;
use Symfony\Component\HttpFoundation\Request;

class MatiereController extends controller
{
    public function ajouterMatiereAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $matiere = new Matiere();
        $form = $this->createForm( MatiereType::class, $matiere);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em->persist($matiere);
            $em->flush();
            return $this->redirect($this->generateUrl('faculte_admin_matieres'));
        }

        return $this->render('FaculteAdminBundle:Matiere:ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function modifierMatiereAction($idM,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $matiere=$em->getRepository('FaculteAdminBundle:Matiere')->findOneById($idM);
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->isMethod('POST')) {
                $em->persist($matiere);
                $em->flush();

                return $this->redirect($this->generateUrl('faculte_admin_matieres'));
            }
        }

        return $this->render('FaculteAdminBundle:Matiere:modifier.html.twig', array(
            'form' => $form->createView(),'Matiere'=>$matiere));

    }


    public function supprimerMatiereAction($idM,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Matiere=$em->getRepository('FaculteAdminBundle:Matiere')->findOneById($idM);
        $em->remove($Matiere);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_matieres'));


    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Matieres=$em->getRepository('FaculteAdminBundle:Matiere')->findAll();
        return $this->render('FaculteAdminBundle:Matiere:index.html.twig',array('Matieres'=>$Matieres));

    }

    public function renderNiveauAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idFiliere = $request->request->get('idfiliere');
        $filiere = $em->getRepository('FaculteAdminBundle:Filiere')->find($idFiliere);
        $niveaux = $em->getRepository('FaculteAdminBundle:Niveau')->findBy(array('filiere'=>$filiere));

        $idMatiere = $request->request->get('idMatiere');
        $matiere = null;
        if(!empty($idMatiere)){
            $matiere = $em->getRepository('FaculteAdminBundle:Matiere')->find($idMatiere);
        }

        return $this->render('FaculteAdminBundle:Matiere:renderNiveau.html.twig',array('niveaux'=>$niveaux,'matiere'=>$matiere));
    }








}