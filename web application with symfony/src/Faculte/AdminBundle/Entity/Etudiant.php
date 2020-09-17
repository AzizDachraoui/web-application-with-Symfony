<?php

namespace Faculte\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="Faculte\AdminBundle\Repository\EtudiantRepository")
 */
class Etudiant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="CIN", type="integer")
     */
    private $CIN;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="votre nom ne peut pas contenir des numéro"
     * )
     */

    private $nom;


    /**
     * @ORM\ManyToMany(targetEntity="Filiere", inversedBy="etudiant")
     */
    private $filiere;


    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="votre prenom ne peut pas contenir des numéro"
     * )
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateNaissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="LieuNaissance", type="string", length=255)
     */
    private $lieuNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255)
     */
    private $nationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     * @Assert\Type(type="numeric", message="Ce champ ne peut pas contenir des caractéres alphabetique.")
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

  /*******************************/
    /**
     * @ORM\ManyToOne(targetEntity="Groupe", inversedBy="etudiant")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id")
     */
    private $groupe;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\OneToMany(targetEntity="AbsenceEtd", mappedBy="etudiant",cascade={"remove"})
     *
     */
    private $absenceEtds;


    /****************************************************/

    public function __toString()
    {
        return  (string)$this->getNom();

    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->absenceEtds = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publiers = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cIN
     *
     * @param integer $cIN
     *
     * @return Etudiant
     */
    public function setCIN($cIN)
    {
        $this->CIN = $cIN;

        return $this;
    }

    /**
     * Get cIN
     *
     * @return integer
     */
    public function getCIN()
    {
        return $this->CIN;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Etudiant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Etudiant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Etudiant
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set lieuNaissance
     *
     * @param string $lieuNaissance
     *
     * @return Etudiant
     */
    public function setLieuNaissance($lieuNaissance)
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    /**
     * Get lieuNaissance
     *
     * @return string
     */
    public function getLieuNaissance()
    {
        return $this->lieuNaissance;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Etudiant
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Etudiant
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Etudiant
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Etudiant
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set groupe
     *
     * @param \Faculte\AdminBundle\Entity\Groupe $groupe
     *
     * @return Etudiant
     */
    public function setGroupe(\Faculte\AdminBundle\Entity\Groupe $groupe = null)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \Faculte\AdminBundle\Entity\Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set user
     *
     * @param \Faculte\AdminBundle\Entity\User $user
     *
     * @return Etudiant
     */
    public function setUser(\Faculte\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Faculte\AdminBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add absenceEtd
     *
     * @param \Faculte\AdminBundle\Entity\AbsenceEtd $absenceEtd
     *
     * @return Etudiant
     */
    public function addAbsenceEtd(\Faculte\AdminBundle\Entity\AbsenceEtd $absenceEtd)
    {
        $this->absenceEtds[] = $absenceEtd;

        return $this;
    }

    /**
     * Remove absenceEtd
     *
     * @param \Faculte\AdminBundle\Entity\AbsenceEtd $absenceEtd
     */
    public function removeAbsenceEtd(\Faculte\AdminBundle\Entity\AbsenceEtd $absenceEtd)
    {
        $this->absenceEtds->removeElement($absenceEtd);
    }

    /**
     * Get absenceEtds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbsenceEtds()
    {
        return $this->absenceEtds;
    }
}
