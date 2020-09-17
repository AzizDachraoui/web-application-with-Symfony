<?php
namespace Faculte\AdminBundle\Controller;


use Faculte\AdminBundle\FaculteAdminBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Niveau;
use Faculte\AdminBundle\Entity\Filiere;
use Faculte\AdminBundle\Form\NiveauType;
use Symfony\Component\HttpFoundation\Request;


class NiveauController extends controller
{
    public function ajouterniveauAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $niveau = new Niveau();
        $form = $this->createForm( NiveauType::class, $niveau);
        $form->handleRequest($request);

            if($form->isValid())
            {
                $em->persist($niveau);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_admin_niveaux'));

            }
                return $this->render('FaculteAdminBundle:Niveau:ajouter.html.twig', array(
                    'form' => $form->createView()));


        }


    public function modifierniveauAction($idN,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $niveau=$em->getRepository('FaculteAdminBundle:Niveau')->findOneById($idN);
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->isMethod('POST')) {
                $em->persist($niveau);
                $em->flush();

                return $this->redirect($this->generateUrl('faculte_admin_niveaux'));
            }
        }

        return $this->render('FaculteAdminBundle:Niveau:modifier.html.twig', array(
            'form' => $form->createView(),'Niveau'=>$niveau));

    }


    public function supprimerNiveauAction($idN,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Niveau=$em->getRepository('FaculteAdminBundle:Niveau')->findOneById($idN);
        $em->remove($Niveau);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_niveaux'));


    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Niveaux=$em->getRepository('FaculteAdminBundle:Niveau')->findAll();
        return $this->render('FaculteAdminBundle:Niveau:index.html.twig',array('Niveaux'=>$Niveaux));

    }












}