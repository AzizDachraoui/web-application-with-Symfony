<?php
namespace Faculte\AdminBundle\Controller;


use Faculte\AdminBundle\Entity\Publier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Form\PublierType;
use Faculte\AdminBundle\Form\PublierEditType;
use Faculte\AdminBundle\Form\PublierFileEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class PublierSimpleController extends controller
{
        public function ajouterpublierAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $publier = new Publier();
        $form = $this->createForm(PublierType::class, $publier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            if ($request->getMethod() == 'POST') {
                $publier = $form->getData();
                $publier ->uploadPathFile();
                $em->persist($publier );
                $em->flush();
                $publier ->movePathFile();

                $Emails = null ;
                $inscriptions = $em->getRepository('FaculteAdminBundle:Inscription')->findAll();
                foreach ($inscriptions as $inscription) {
                    $Emails[] =  $inscription->getUser()->getEmail();

                }

                $message = \Swift_Message::newInstance()->setContentType("text/html")
                    ->setSubject('nou')
                    ->setFrom('saffarrahma50@gmail.com')
                    ->setTo($Emails)
                    ->setBody($this->renderView('FaculteAdminBundle:Publier:contenuEmail.html.twig',
                        array('inscription' => $inscriptions, 'publiers' => $publier), 'text/html'));
                $this->get('mailer')->send($message);



                $Envoi = null ;
                $etudiants = $em->getRepository('FaculteAdminBundle:Etudiant')->findAll();

                foreach ($etudiants as $etudiant) {
                    $Envoi[] =  $etudiant->getUser()->getEmail();



                }

                $message = \Swift_Message::newInstance()->setContentType("text/html")
                    ->setSubject('nou')
                    ->setFrom('saffarrahma50@gmail.com')
                    ->setTo($Envoi)
                    ->setBody($this->renderView('FaculteAdminBundle:Publier:contenuEmail.html.twig',
                        array('etudiant' => $etudiants, 'publiers' => $publier), 'text/html'));
                $this->get('mailer')->send($message);
                return $this->redirect($this->generateUrl('faculte_admin_publiers'));

            }
        }
        return $this->render('FaculteAdminBundle:Publier:ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function modifierpublierAction($idP,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $publier=$em->getRepository('FaculteAdminBundle:Publier')->findOneById($idP);
        $form = $this->createForm(PublierEditType::class, $publier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->isMethod('POST')) {
                $em->persist($publier);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_admin_publiers'));
            }
        }

        return $this->render('FaculteAdminBundle:Publier:modifier.html.twig', array(
            'form' => $form->createView(),'publier'=>$publier ));

    }


    public function supprimerpublierAction($idP,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $publier=$em->getRepository('FaculteAdminBundle:Publier')->findOneById($idP);
        $em->remove( $publier);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_publiers'));


    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $publier = $em->getRepository('FaculteAdminBundle:Publier')->findAll();
        return $this->render('FaculteAdminBundle:Publier:index.html.twig', array('publier'=>$publier ));
    }

    public function modifierpublierFileAction($idP,Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $publier=$em->getRepository('FaculteAdminBundle:Publier')->findOneById($idP);
        $form = $this->createForm(PublierFileEditType::class, $publier);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $publier->uploadPathFile();
            $em->persist($publier);
            $em->flush();
            return $this->redirect($this->generateUrl('faculte_admin_publiers'));
        }
        return $this->render('FaculteAdminBundle:Publier:modifierEdit.html.twig', array(
            'publier'=>$publier, 'form' => $form->createView()
        ));
    }

}