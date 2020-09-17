<?php
namespace Faculte\AdminBundle\Controller;



use Faculte\AdminBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Enseignant;
use Faculte\AdminBundle\Form\EnseignantType;
use Faculte\AdminBundle\Form\UserType;
use Faculte\AdminBundle\Form\UserEditType;
use Symfony\Component\HttpFoundation\Request;

class EnseignantController extends controller
{
    public function ajouterEnseignantAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Enseignant = new Enseignant();
        $form = $this->createForm( EnseignantType::class, $Enseignant);
        $form->handleRequest($request);
        $user = new User();
        $form2 = $this->createForm( UserType::class, $user);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $form2->isSubmitted() && $form2->isValid()) {
            if ($request->getMethod() == 'POST') {
                /**@var Enseignant $Enseignant**/
                $Enseignant = $form->getData();
                //recuperer les données du formulaire
                /**@var User $user*/
                $user = $form2->getData();
                //ajouter role enseignant
                $role = array('ROLE_ENSEIGNANT');
                $user->setRoles($role);
                $user->setEnabled(true);
                $passwordEnseignant = $user->getPlainPassword();

                //persist(mis en memoire l'objet $user
                $em->persist($user);
                //affecter l'objet user à l'enseignant
                $Enseignant->setUser($user);
                //persist(mis en memoire l'objet $enseignant
                $em->persist($Enseignant);
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
                    return $this->render('FaculteAdminBundle:Enseignant:ajouter.html.twig', array(
                        'form' => $form->createView(),'form2' => $form2->createView(),'errorUsername'=>$errorUsername,'errorEmail'=>$errorEmail
                    ));
                }

                $message = \Swift_Message::newInstance()
                    ->setSubject( $Enseignant->getNom()." ".$Enseignant->getPrenom())
                    ->setFrom('saffarrahma50@gmail.com')
                    ->setTo($Enseignant->getUser()->getEmail())
                    ->setBody($this->renderView('FaculteAdminBundle:Enseignant:contenuEmail.html.twig',
                        array('Enseignant' => $Enseignant,'passwordEnseignant'=>$passwordEnseignant), 'text/html'))
                    ->setContentType("text/html");
                $this->get('mailer')->send($message);
               return $this->redirect($this->generateUrl('faculte_admin_enseignants'));
            }
        }

        return $this->render('FaculteAdminBundle:Enseignant:ajouter.html.twig', array(
            'form' => $form->createView(),'form2' => $form2->createView()
        ));
    }

    public function modifierEnseignantAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Enseignant=$em->getRepository('FaculteAdminBundle:Enseignant')->findOneById($id);
        $user=$Enseignant->getUser();
        $form = $this->createForm(EnseignantType::class, $Enseignant);
        $form2 = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $form2->isSubmitted() && $form2->isValid()) {
            if ($request->isMethod('POST')) {
                $Enseignant = $form->getData();
                $user = $form2->getData();
                $em->persist($user);
                $Enseignant->setUser($user);
                $em->persist($Enseignant);
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
                    return $this->render('FaculteAdminBundle:Enseignant:modifier.html.twig', array(
                        'form' => $form->createView(),'form2' => $form2->createView(),'Enseignant'=>$Enseignant,'errorUsername'=>$errorUsername,'errorEmail'=>$errorEmail
                    ));
                }
                return $this->redirect($this->generateUrl('faculte_admin_enseignants'));
            }
        }

        return $this->render('FaculteAdminBundle:Enseignant:modifier.html.twig', array(
            'form' => $form->createView(),'form2' => $form2->createView(),'Enseignant'=>$Enseignant));

    }


    public function supprimerEnseignantAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Enseignant=$em->getRepository('FaculteAdminBundle:Enseignant')->findOneById($id);
            $em->remove($Enseignant);
            $em->remove($Enseignant->getUser());
            $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_enseignants'));


        }
    public function desactiverEnseignantAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository('FaculteAdminBundle:User')->findOneById($id);
        $user->setEnabled(0);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_enseignants'));


    }
    public function activerEnseignantAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository('FaculteAdminBundle:User')->findOneById($id);
        $user->setEnabled(1);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_admin_enseignants'));


    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Enseignants=$em->getRepository('FaculteAdminBundle:Enseignant')->findAll();
        return $this->render('FaculteAdminBundle:Enseignant:index.html.twig',array('Enseignants'=>$Enseignants));

    }












}