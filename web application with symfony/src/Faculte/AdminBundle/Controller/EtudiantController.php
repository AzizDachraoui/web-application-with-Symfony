<?php
namespace Faculte\AdminBundle\Controller;



use Faculte\AdminBundle\Entity\User;
use Faculte\AdminBundle\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Etudiant;
use Faculte\AdminBundle\Form\EtudiantType;
use Faculte\AdminBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;

class EtudiantController extends controller
{
    public function ajouterEtudiantAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Etudiant = new Etudiant();
        $form = $this->createForm( EtudiantType::class, $Etudiant);
        $form->handleRequest($request);
        $user = new User();
        $form2 = $this->createForm( UserType::class, $user);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $form2->isSubmitted() && $form2->isValid()) {
            if ($request->getMethod() == 'POST') {
                $Etudiant = $form->getData();
                //recuperer les données du formulaire
                /**@var User $user*/
                $user = $form2->getData();
                $role = array('ROLE_ETUDIANT');
                $user->setRoles($role);
                $user->setEnabled(true);
                $passwordEtudiant = $user->getPlainPassword();

                //persist(mis en memoire l'objet $user
                $em->persist($user);

                //affecter l'objet user à l'etudiant
                $Etudiant->setUser($user);
                //persist(mis en memoire l'objet $etudiant
                $em->persist($Etudiant);
                try {

                    $em->flush();

                } catch (\Exception $e) {
                    $users=$em->getRepository('FaculteAdminBundle:User')->findAll();
                    $errorUsername="";
                    $errorEmail="";
                    //chercher l'existance du username dans UserFos
                    foreach($users as $userfos){
                        if( $userfos->getUsername() == $user->getUsername()){
                            $errorUsername = "Le nom d'utilisateur est déjà utilisé" ;
                        }elseif($userfos->getEmail() == $user->getEmail()){
                            $errorEmail = "L'adresse e-mail est déjà utilisée" ;
                        }
                    }
                    return $this->render('FaculteAdminBundle:Etudiant:ajouter.html.twig', array(
                        'form' => $form->createView(),'form2' => $form2->createView(),'errorUsername'=>$errorUsername,'errorEmail'=>$errorEmail
                    ));
                }


                $message = \Swift_Message::newInstance()
                    ->setSubject( $Etudiant->getNom()." ".$Etudiant->getPrenom())
                    ->setFrom('saffarrahma50@gmail.com')
                    ->setTo($Etudiant->getUser()->getEmail())
                    ->setBody($this->renderView('FaculteAdminBundle:Etudiant:contenuEmail.html.twig',
                        array('Etudiant' => $Etudiant,'passwordEtudiant'=>$passwordEtudiant), 'text/html'))
                    ->setContentType("text/html");
                $this->get('mailer')->send($message);
                return $this->redirect($this->generateUrl('faculte_admin_etudiants'));
            }
        }

        return $this->render('FaculteAdminBundle:Etudiant:ajouter.html.twig', array(
            'form' => $form->createView(),'form2' => $form2->createView()
        ));
    }

    public function modifierEtudiantAction($idE,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Etudiant=$em->getRepository('FaculteAdminBundle:Etudiant')->findOneById($idE);
        $user=$Etudiant->getUser();
        $form = $this->createForm(EtudiantType::class, $Etudiant);
        $form2 = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $form2->isSubmitted() && $form2->isValid()) {
            if ($request->isMethod('POST')) {
                $Etudiant = $form->getData();
                $user = $form2->getData();
                $em->persist($user);
                $Etudiant->setUser($user);
                $em->persist($Etudiant);
                try {

                    $em->flush();

                } catch (\Exception $e) {
                    $users=$em->getRepository('FaculteAdminBundle:User')->findAll();
                    $errorUsername="";
                    $errorEmail="";
                    //chercher l'existance du username dans UserFos
                    foreach($users as $userfos){
                        if( $userfos->getUsername() == $user->getUsername()){
                            $errorUsername = "Le nom d'utilisateur est déjà utilisé" ;
                        }elseif($userfos->getEmail() == $user->getEmail()){
                            $errorEmail = "L'adresse e-mail est déjà utilisée" ;
                        }
                    }
                    return $this->render('FaculteAdminBundle:Etudiant:modifier.html.twig', array(
                        'form' => $form->createView(),'form2' => $form2->createView(),'Etudiant'=>$Etudiant,'errorUsername'=>$errorUsername,'errorEmail'=>$errorEmail
                    ));
                }

                return $this->redirect($this->generateUrl('faculte_admin_etudiants'));
            }
        }

        return $this->render('FaculteAdminBundle:Etudiant:modifier.html.twig', array(
            'form' => $form->createView(),'form2' => $form2->createView(),'Etudiant'=>$Etudiant));

    }


    public function supprimerEtudiantAction($idE)
    {
        $em = $this->getDoctrine()->getManager();
        $Etudiant=$em->getRepository('FaculteAdminBundle:Etudiant')->findOneById($idE);
        $em->remove($Etudiant);
        $em->remove($Etudiant->getUser());
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_etudiants'));
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Etudiants=$em->getRepository('FaculteAdminBundle:Etudiant')->findAll();
        return $this->render('FaculteAdminBundle:Etudiant:index.html.twig',array('Etudiants'=>$Etudiants));

    }


    public function renderNiveauxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idFiliere = $request->request->get('idfiliere');
        $filiere = $em->getRepository('FaculteAdminBundle:Filiere')->find($idFiliere);
        $niveaux = $em->getRepository('FaculteAdminBundle:Niveau')->findBy(array('filiere'=>$filiere));

        $idEtudiant = $request->request->get('idEtudiant');
        $etudiant = null;
        if(!empty($idEtudiant)){
            $etudiant = $em->getRepository('FaculteAdminBundle:Etudiant')->find($idEtudiant);
        }

        return $this->render('FaculteAdminBundle:Etudiant:renderNiveaux.html.twig',array('niveaux'=>$niveaux,'etudiant'=>$etudiant));
    }

    public function renderGroupesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idNiveau = $request->request->get('idNiveau');
        $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idNiveau);
        $groupes = $em->getRepository('FaculteAdminBundle:Groupe')->findBy(array('niveau'=>$niveau));


        $idEtudiant = $request->request->get('idEtudiant');
        $etudiant = null;
        if(!empty($idEtudiant)){
            $etudiant = $em->getRepository('FaculteAdminBundle:Etudiant')->find($idEtudiant);
        }

        return $this->render('FaculteAdminBundle:Etudiant:renderGroupes.html.twig',array('groupes'=>$groupes,'etudiant'=>$etudiant));
    }



    public function desactiverEtudiantAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository('FaculteAdminBundle:User')->findOneById($id);
        $user->setEnabled(0);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_etudiants'));


    }
    public function activerEtudiantAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository('FaculteAdminBundle:User')->findOneById($id);
        $user->setEnabled(1);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_etudiants'));


    }





}