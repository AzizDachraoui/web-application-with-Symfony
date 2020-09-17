<?php
namespace Faculte\EnseignantBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Entity\Enseignant;
use Faculte\AdminBundle\Entity\DemandeRattrapage;
use Faculte\AdminBundle\Form\DemandeRattrapageType;
use Symfony\Component\HttpFoundation\Request;


class DemandeRattrapageController extends controller
{
    public function ajouterDemandeRattrapageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $demande = new DemandeRattrapage();
        $form = $this->createForm( DemandeRattrapageType::class, $demande);
        $form->handleRequest($request);
        $user = $this->getUser();
        $enseignant = $em->getRepository('FaculteAdminBundle:Enseignant')->findOneBy(array('user' => $user));
        if (!empty($enseignant)) {
        if ($form->isSubmitted() && $form->isValid() ) {
                $demande->setEnseignant($enseignant);
                $demande->setConsulter(false);
                $em->persist($demande);
                $em->flush();
                return $this->redirect($this->generateUrl('faculte_enseignant_demanderattrapages'));

        }}

        return $this->render('FaculteEnseignantBundle:DemandeRattrapage:ajouter.html.twig', array(
            'form' => $form->createView()));
}


    public function supprimerDemandeRattrapageAction($idD,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $demande=$em->getRepository('FaculteAdminBundle:DemandeRattrapage')->findOneById($idD);
        $em->remove($demande);
        $em->flush();
        return $this->redirect($this->generateUrl('faculte_enseignant_demanderattrapages'));


    }
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $enseignant = $em->getRepository('FaculteAdminBundle:Enseignant')->findOneBy(array('user' => $user));
        $demande = $em->getRepository('FaculteAdminBundle:DemandeRattrapage')->findBy(array('enseignant' => $enseignant));
        return $this->render('FaculteEnseignantBundle:DemandeRattrapage:index.html.twig', array('demandes'=>$demande));

    }

    public function renderNiveauxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idFiliere = $request->request->get('idfiliere');
        $filiere = $em->getRepository('FaculteAdminBundle:Filiere')->find($idFiliere);
        $niveaux = $em->getRepository('FaculteAdminBundle:Niveau')->findBy(array('filiere'=>$filiere));

        $idDemandeRattrapage = $request->request->get('idDemandeRattrapage');
        $demandeRattrapage = null;
        if(!empty($idDemandeRattrapage)){
            $demandeRattrapage = $em->getRepository('FaculteAdminBundle:DemandeRattrapage')->find($idDemandeRattrapage);
        }

        return $this->render('FaculteEnseignantBundle:DemandeRattrapage:renderNiveaux.html.twig',
            array('niveaux'=>$niveaux,'demandeRattrapage'=>$demandeRattrapage));
    }


    public function renderGroupesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idNiveau = $request->request->get('idNiveau');
        $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idNiveau);
        $groupes = $em->getRepository('FaculteAdminBundle:Groupe')->findBy(array('niveau'=>$niveau));

        $idDemandeRattrapage = $request->request->get('idDemandeRattrapage');
        $demandeRattrapage = null;
        if(!empty($idDemandeRattrapage)){
            $demandeRattrapage = $em->getRepository('FaculteAdminBundle:DemandeRattrapage')->find($idDemandeRattrapage);
        }


        return $this->render('FaculteEnseignantBundle:DemandeRattrapage:renderGroupes.html.twig',array('groupes'=>$groupes,'demandeRattrapage'=>$demandeRattrapage));
    }
    public function renderMatieresAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idNiveau = $request->request->get('idNiveau');
        $niveau = $em->getRepository('FaculteAdminBundle:Niveau')->find($idNiveau);
        $user = $this->getUser();
        $enseignant = $em->getRepository('FaculteAdminBundle:Enseignant')->findOneBy(array('user' => $user));
        $Enseignantmatieres = $enseignant->getMatieres();
        $matieres = null ;
         foreach ($Enseignantmatieres as $Enseignantmatiere){
            /**@var \Faculte\AdminBundle\Entity\Matiere $Enseignantmatiere**/
            foreach ($Enseignantmatiere->getNiveaux() as $niveauMatiereEns){
                if($niveau->getId() == $niveauMatiereEns->getId()){
                    $matieres[] = $Enseignantmatiere ;
                }
            }
        }


        $idDemandeRattrapage = $request->request->get('idDemandeRattrapage');
        $demandeRattrapage = null;
        if(!empty($idDemandeRattrapage)){
            $demandeRattrapage = $em->getRepository('FaculteAdminBundle:DemandeRattrapage')->find($idDemandeRattrapage);
        }



        return $this->render('FaculteEnseignantBundle:DemandeRattrapage:renderMatieres.html.twig',array('matieres'=>$matieres,'niveau'=>$niveau ,'enseignant'=>$enseignant  ,'demandeRattrapage'=>$demandeRattrapage));
    }


}