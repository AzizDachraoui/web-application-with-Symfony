<?php
namespace Faculte\AdminBundle\Controller;



use Faculte\AdminBundle\Entity\Inscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ListeInscriptionController extends controller
{


    public function ListeInscriptionsAction()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $ListeInscriptions=$em->getRepository('FaculteAdminBundle:Inscription')->findAll();
            return $this->render('FaculteAdminBundle:ListeInscription:index.html.twig', array('inscription' => $ListeInscriptions));

        }
    }

    public function notifDemandeAction($max)
    {
        $em = $this->getDoctrine()->getManager();
        $nonconsultdem=$em->getRepository('FaculteAdminBundle:Inscription')->findALL();
        $nbrNonConsulterDemande =  count($nonconsultdem);

        $nonConsulterdemandes = $em->getRepository('FaculteAdminBundle:Inscription')->findByMaxNonConsulter($max);

        return $this->render('FaculteAdminBundle:ListeInscription:notifDemandeInscription.html.twig',
            array('nonConsulterdemandes'=>$nonConsulterdemandes,'nbrNonConsulterDemande'=>$nbrNonConsulterDemande));

    }


}