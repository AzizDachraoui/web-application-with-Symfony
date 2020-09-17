<?php

namespace Faculte\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Faculte\AdminBundle\Entity\User;
use Faculte\AdminBundle\Entity\Inscription;
use Faculte\AdminBundle\Form\InscriptionType;
use Faculte\AdminBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;

class InscriptionController extends Controller{

    public function inscriptionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Inscription = new Inscription();
        $form = $this->createForm( InscriptionType::class, $Inscription);
        $form->handleRequest($request);
        $user = new User();
        $form2 = $this->createForm( UserType::class, $user);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()&& $form2->isSubmitted() && $form2->isValid() ) {
            if ($request->getMethod() == 'POST') {
                $Inscription = $form->getData();
                $user = $form2->getData();
                $user->setEnabled(true);
                $em->persist($user);
                $Inscription->setUser($user);
                $em->persist($Inscription);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_front_demandeEnregistre'));
            }
        }

        return $this->render('FaculteFrontBundle:Inscription:inscription.html.twig', array(
            'form' => $form->createView(),'form2' => $form2->createView()
        ));
    }

    public function demandeEnregistreAction()
    {
        return $this->render('FaculteFrontBundle:Inscription:demandeEnregistre.html.twig');
    }

}
