<?php
namespace Faculte\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Resultat;
use Faculte\AdminBundle\Form\ResultatType;
use Faculte\AdminBundle\Form\ResultatEditType;
use Faculte\AdminBundle\Form\ResultatFileEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ResultatController extends controller
{
    public function ajouterResultatAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $resultats = new Resultat();
        $form = $this->createForm(ResultatType::class, $resultats);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            if ($request->getMethod() == 'POST') {
                $RESULTATSS=$em->getRepository('FaculteAdminBundle:Resultat')->findAll();
                /**@var Resultat $resultats**/
                $resultats = $form->getData();
                $find=false;
                foreach ($RESULTATSS as $resultat){
                    /**@var Resultat $resultat**/
                    if($resultats->getNom() == $resultat->getNom() &&
                        $resultats->getNiveau()->getId() == $resultat->getNiveau()->getId() ) {
                        $find=true;
                        break;
                    }
                }

                if($find==true){
                    $errorResultatExist = "Le résultat déjà existe";
                    return $this->render('FaculteAdminBundle:Resultat:ajouter.html.twig', array(
                        'form' => $form->createView(),'errorResultatExist'=>$errorResultatExist,
                    ));
                }else{
                    $resultats->uploadPathFile();
                    $em->persist($resultats);
                    $em->flush();
                    $resultats->movePathFile();
                    return $this->redirect($this->generateUrl('faculte_admin_resultats'));
                }
            }
        }
        return $this->render('FaculteAdminBundle:Resultat:ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function modifierResultatAction($idR,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $resultats=$em->getRepository('FaculteAdminBundle:Resultat')->findOneById($idR);
        $form = $this->createForm(ResultatEditType::class, $resultats);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            if ($request->getMethod() == 'POST') {
                $RESULTATSS=$em->getRepository('FaculteAdminBundle:Resultat')->findWithoutId($idR);
                /**@var Resultat $resultats**/
                $resultats = $form->getData();
                $find=false;
                foreach ($RESULTATSS as $resultat){
                    /**@var Resultat $resultat**/
                    if($resultats->getNom() == $resultat->getNom() &&
                        $resultats->getNiveau()->getId() == $resultat->getNiveau()->getId() ) {
                        $find=true;
                        break;
                    }
                }

                if($find==true){
                    $errorResultatExist = "Le résultat déjà existe";
                    return $this->render('FaculteAdminBundle:Resultat:modifier.html.twig', array(
                        'form' => $form->createView(),'resultats'=>$resultats,'errorResultatExist'=>$errorResultatExist,
                    ));
                }else {
                    $em->persist($resultats);
                    $em->flush();
                    return $this->redirect($this->generateUrl('faculte_admin_resultats'));
                }
            }
        }

        return $this->render('FaculteAdminBundle:Resultat:modifier.html.twig', array(
            'form' => $form->createView(),'resultats'=>$resultats));

    }


    public function supprimerResultatAction($idR,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $resultats=$em->getRepository('FaculteAdminBundle:Resultat')->findOneById($idR);
        $em->remove( $resultats);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_resultats'));


    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $resultats = $em->getRepository('FaculteAdminBundle:Resultat')->findAll();
        return $this->render('FaculteAdminBundle:Resultat:index.html.twig', array('resultats' =>  $resultats));
    }


    public function modifierResultatFileAction($idR, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $resultat=$em->getRepository('FaculteAdminBundle:Resultat')->findOneById($idR);
        $form = $this->createForm(ResultatFileEditType::class, $resultat);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $resultat = $form->getData();
            $resultat ->uploadPathFile();
            $em->persist($resultat);
            $em->flush();


            return $this->redirect($this->generateUrl('faculte_admin_resultats'));
        }
        return $this->render('FaculteAdminBundle:Resultat:modifierEdit.html.twig', array('resultat'=>$resultat,
            'form' => $form->createView()
        ));
    }
    public function renderNiveauAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idFiliere = $request->request->get('idfiliere');
        $filiere = $em->getRepository('FaculteAdminBundle:Filiere')->find($idFiliere);
        $niveaux = $em->getRepository('FaculteAdminBundle:Niveau')->findBy(array('filiere' => $filiere));


        $idResultat= $request->request->get('idResultat');
        $resultat = null;
        if(!empty($idResultat)){
            $resultat = $em->getRepository('FaculteAdminBundle:Resultat')->find($idResultat);
        }

        return $this->render('FaculteAdminBundle:Resultat:renderNiveau.html.twig', array('niveaux' => $niveaux ,'resultat'=>$resultat));
    }



}