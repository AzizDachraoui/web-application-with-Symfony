<?php
namespace Faculte\AdminBundle\Controller;



use Faculte\AdminBundle\Entity\Etudiant;
use Faculte\AdminBundle\Entity\Groupe;
use Faculte\AdminBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\AbsenceEtd;
use Faculte\AdminBundle\Form\AbsenceEtdType;
use Symfony\Component\HttpFoundation\Request;

class AbsenceEtdController extends controller
{

    public function indexAction($idGroupe)
    {
        $em = $this->getDoctrine()->getManager();
        /**@var Groupe $groupe*/
        $groupe = $em->getRepository('FaculteAdminBundle:Groupe')->find($idGroupe);
        $matieres = $groupe->getNiveau()->getMatieres();

        $etudiants=$em->getRepository('FaculteAdminBundle:Etudiant')->findBy(array('groupe'=>$groupe));
        return $this->render('FaculteAdminBundle:AbsenceEtd:index.html.twig',array('groupe'=>$groupe,
            'etudiants'=>$etudiants,'matieres'=>$matieres));

    }



    public function FilieresAction()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
            return $this->render('FaculteAdminBundle:AbsenceEtd:Filieres.html.twig', array('Filieres' => $Filieres));

        }
    }

    public function groupesAction($idNiveau)
    {

        $em = $this->getDoctrine()->getManager();
        $Filieres=$em->getRepository('FaculteAdminBundle:Filiere')->findAll();
        $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idNiveau);
        $groupes=$em->getRepository('FaculteAdminBundle:Groupe')->findBy(array('niveau'=>$niveau));
        return $this->render('FaculteAdminBundle:AbsenceEtd:groupes.html.twig', array('Filieres' => $Filieres,
            'groupes' => $groupes,'niveau'=>$niveau ));


    }

    public function searchEtdAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idGroupe = $request->request->get('idGroupe');
        $idMatiere = $request->request->get('idMatiere');
        /**@var Groupe $groupe*/
        $groupe = $em->getRepository('FaculteAdminBundle:Groupe')->find($idGroupe);
        /**@var Matiere $matiere*/
        $matiere = $em->getRepository('FaculteAdminBundle:Matiere')->find($idMatiere);
        /**@var AbsenceEtd $absenceEtd*/
        $absenceEtds=$em->getRepository('FaculteAdminBundle:AbsenceEtd')->findByGroupeAndMatiere($idMatiere,$idGroupe);

        $etudiants=$em->getRepository('FaculteAdminBundle:Etudiant')->findBy(array('groupe'=>$groupe));
        return $this->render('FaculteAdminBundle:AbsenceEtd:searchEtd.html.twig',array('groupe'=>$groupe,
            'etudiants'=>$etudiants,'absenceEtds'=>$absenceEtds,'matiere'=>$matiere));

    }

    public function modalAbsenceEtdAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idEtd = $request->request->get('idEtd');
        $idMatiere = $request->request->get('idMatiere');
        $absenceEtd = null;

            /**@var Matiere $matiere */
            $matiere = $em->getRepository('FaculteAdminBundle:Matiere')->find($idMatiere);
            /**@var Etudiant $etudiant */
            $etudiant = $em->getRepository('FaculteAdminBundle:Etudiant')->find($idEtd);
            /**@var AbsenceEtd $absenceEtd*/
            $absenceEtd=$em->getRepository('FaculteAdminBundle:AbsenceEtd')->findByEtdAndMatiere($idMatiere,$idEtd);

        if(empty($absenceEtd)){
            $absenceEtd = new AbsenceEtd();
            $absenceEtd->setEtudiant($etudiant);
            $absenceEtd->setMatiere($matiere);
        }

        $form = $this->createForm(AbsenceEtdType::class, $absenceEtd);
        $nbrAbsence = $request->request->get('nbrAbsence');
        if($nbrAbsence != null){
            $absenceEtd->setNbAbsence($nbrAbsence);
            $em->persist($absenceEtd);
            $em->flush();

            if($nbrAbsence == 3 || $nbrAbsence == 4) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($etudiant->getNom() . " " . $etudiant->getPrenom())
                    ->setFrom('saffarrahma50@gmail.com')
                    ->setTo($etudiant->getUser()->getEmail())
                    ->setBody($this->renderView('FaculteAdminBundle:AbsenceEtd:contenuEmail.html.twig',
                        array('etudiant' => $etudiant, 'nbrAbsence'=>$nbrAbsence,'matiere' => $matiere, 'text/html')))
                    ->setContentType("text/html");
                $this->get('mailer')->send($message);
            }
        }

        return $this->render('FaculteAdminBundle:AbsenceEtd:modalAbsenceEtd.html.twig',array(
            'etudiant'=>$etudiant,'matiere'=>$matiere, 'form' => $form->createView()));

    }


}