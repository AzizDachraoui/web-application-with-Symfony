<?php
namespace Faculte\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\EmploiTemps;
use Faculte\AdminBundle\Form\EmploiTempsType;
use Faculte\AdminBundle\Form\EmploiTempsEditType;
use Faculte\AdminBundle\Form\EmploiTempsFileEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class EmploiTempsController extends controller
{
    public function ajouteremploitempsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $emploistemps = new EmploiTemps();
        $form = $this->createForm(EmploiTempsType::class, $emploistemps);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            if ($request->getMethod() == 'POST') {
                $emploiTmps=$em->getRepository('FaculteAdminBundle:EmploiTemps')->findAll();
                /**@var EmploiTemps $emploistemps**/
                $emploistemps = $form->getData();
                $find=false;
                foreach ($emploiTmps as $emploi){
                    /**@var EmploiTemps $emploi**/
                  if($emploi->getNom() == $emploistemps->getNom() &&
                      $emploi->getGroupe()->getId() == $emploistemps->getGroupe()->getId() ) {
                      $find=true;
                      break;
                  }
                }

                if($find==true){
                    $errorEmploiExist = "l'emploi de temps déjà existe";
                    return $this->render('FaculteAdminBundle:EmploiTemps:ajouter.html.twig', array(
                        'form' => $form->createView(),'errorEmploiExist'=>$errorEmploiExist,
                    ));
                }else{
                    $emploistemps ->uploadPathFile();
                    $em->persist($emploistemps );
                    $em->flush();
                    $emploistemps ->movePathFile();
                    return $this->redirect($this->generateUrl('faculte_admin_emploitemps'));
                }

            }
        }
        return $this->render('FaculteAdminBundle:EmploiTemps:ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function modifieremploitempsAction($idET,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $emploitemps=$em->getRepository('FaculteAdminBundle:EmploiTemps')->findOneById($idET);
        $form = $this->createForm(EmploiTempsEditType::class, $emploitemps);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->isMethod('POST')) {
                $emploiTmps=$em->getRepository('FaculteAdminBundle:EmploiTemps')->findWithoutId($idET);
                /**@var EmploiTemps $emploistemps**/
                $emploistemps = $form->getData();
                $find=false;
                foreach ($emploiTmps as $emploi){
                    /**@var EmploiTemps $emploi**/
                    if($emploi->getNom() == $emploistemps->getNom() &&
                        $emploi->getGroupe()->getId() == $emploistemps->getGroupe()->getId() ) {
                        $find=true;
                        break;
                    }
                }

                if($find==true){
                    $errorEmploiExist = "L'emploi de temps déjà existe";
                    return $this->render('FaculteAdminBundle:EmploiTemps:modifier.html.twig', array(
                        'form' => $form->createView(),'emploitemps'=>$emploitemps,'errorEmploiExist'=>$errorEmploiExist,
                    ));
                }else {
                    $em->persist($emploitemps);
                    $em->flush();
                    return $this->redirect($this->generateUrl('faculte_admin_emploitemps'));
                }
            }
        }

        return $this->render('FaculteAdminBundle:EmploiTemps:modifier.html.twig', array(
            'form' => $form->createView(),'emploitemps'=>$emploitemps));

    }


    public function supprimeremploitempsAction($idET,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $emploistemps=$em->getRepository('FaculteAdminBundle:EmploiTemps')->findOneById($idET);
        $em->remove( $emploistemps);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_emploitemps'));


    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $emploistemps = $em->getRepository('FaculteAdminBundle:EmploiTemps')->findAll();
        return $this->render('FaculteAdminBundle:EmploiTemps:index.html.twig', array('emploistemps' =>  $emploistemps));
    }


    public function modifieremploitempsFileAction($idET, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $emploistemps=$em->getRepository('FaculteAdminBundle:EmploiTemps')->findOneById($idET);
        $form = $this->createForm(EmploiTempsFileEditType::class, $emploistemps);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $emploistemps->uploadPathFile();
            $em->persist($emploistemps);
            $em->flush();
            return $this->redirect($this->generateUrl('faculte_admin_emploitemps'));
        }
        return $this->render('FaculteAdminBundle:EmploiTemps:modifierEdit.html.twig', array('emploistemps' =>  $emploistemps,
            'form' => $form->createView()
        ));
    }
    public function renderNiveauxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idFiliere = $request->request->get('idfiliere');
        $filiere = $em->getRepository('FaculteAdminBundle:Filiere')->find($idFiliere);
        $niveaux = $em->getRepository('FaculteAdminBundle:Niveau')->findBy(array('filiere'=>$filiere));

        $idEmploiTemps= $request->request->get('idEmploiTemps');
        $emploitemps = null;
        if(!empty($idEmploiTemps)){
            $emploitemps = $em->getRepository('FaculteAdminBundle:EmploiTemps')->find($idEmploiTemps);
        }

        return $this->render('FaculteAdminBundle:Emploitemps:renderNiveaux.html.twig',array('niveaux'=>$niveaux,'emploitemps'=>$emploitemps));
    }

    public function renderGroupesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idNiveau = $request->request->get('idNiveau');
        $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idNiveau);
        $groupes = $em->getRepository('FaculteAdminBundle:Groupe')->findBy(array('niveau'=>$niveau));
        $idEmploiTemps = $request->request->get('idEmploiTemps');

        $emploitemps = null;
        if(!empty($idEmploiTemps)){
            $emploitemps = $em->getRepository('FaculteAdminBundle:EmploiTemps')->find($idEmploiTemps);
        }

        return $this->render('FaculteAdminBundle:Emploitemps:renderGroupes.html.twig',array('groupes'=>$groupes,'emploitemps'=>$emploitemps));
    }



}