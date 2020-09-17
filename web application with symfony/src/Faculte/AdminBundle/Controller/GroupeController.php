<?php
namespace Faculte\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Groupe;
use Faculte\AdminBundle\Form\GroupeType;
use Symfony\Component\HttpFoundation\Request;

class GroupeController extends controller
{
    public function ajouterGroupeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Groupe = new Groupe();
        $form = $this->createForm( GroupeType::class, $Groupe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            if ($request->getMethod() == 'POST') {
                $Groupe = $form->getData();
                $em->persist($Groupe);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_admin_groupes'));
            }
        }

        return $this->render('FaculteAdminBundle:Groupe:ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function modifierGroupeAction($idG,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Groupe=$em->getRepository('FaculteAdminBundle:Groupe')->findOneById($idG);
        $form = $this->createForm(GroupeType::class, $Groupe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->isMethod('POST')) {
                $Groupe = $form->getData();
                $em->persist($Groupe);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_admin_groupes'));
            }
        }

        return $this->render('FaculteAdminBundle:Groupe:modifier.html.twig', array(
            'form' => $form->createView(),'Groupe'=>$Groupe));

    }


    public function supprimerGroupeAction($idG,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Groupe=$em->getRepository('FaculteAdminBundle:Groupe')->findOneById($idG);
        $em->remove($Groupe);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_groupes'));


    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Groupes=$em->getRepository('FaculteAdminBundle:Groupe')->findAll();
        return $this->render('FaculteAdminBundle:Groupe:index.html.twig',array('Groupes'=>$Groupes));

    }

    public function renderNiveauxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idFiliere = $request->request->get('idfiliere');
        $idGroupe = $request->request->get('idGroupe');
        $filiere = $em->getRepository('FaculteAdminBundle:Filiere')->find($idFiliere);
        $niveaux = $em->getRepository('FaculteAdminBundle:Niveau')->findBy(array('filiere'=>$filiere));
        $Groupe = null;
        if($idGroupe != null) {
            $Groupe = $em->getRepository('FaculteAdminBundle:Groupe')->find($idGroupe);
        }
        return $this->render('FaculteAdminBundle:Groupe:renderNiveaux.html.twig',
            array('niveaux'=>$niveaux,'Groupe'=>$Groupe));
    }

}