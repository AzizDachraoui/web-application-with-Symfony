<?php

namespace Faculte\FrontBundle\Controller;

use Faculte\AdminBundle\Form\UserContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Contact;
use Faculte\AdminBundle\Entity\User;
use Faculte\AdminBundle\Form\ContactType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;



class ContactController extends Controller
{

    public function contactAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Contact = new Contact();
        $form = $this->createForm( ContactType::class, $Contact);
        $form->handleRequest($request);
        $user = new User();
        $form2 = $this->createForm( UserContactType::class, $user);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()&& $form2->isSubmitted() && $form2->isValid() ) {
            if ($request->getMethod() == 'POST') {
                $Contact = $form->getData();
                $user = $form2->getData();
                $user->setEnabled(true);
                $em->persist($user);
                $Contact->setUser($user);
                $em->persist($Contact);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_front_demandeEnregistre'));
            }
        }

        return $this->render('FaculteFrontBundle:Contact:Contact.html.twig', array(
            'form' => $form->createView(),'form2' => $form2->createView()
        ));
    }

}
