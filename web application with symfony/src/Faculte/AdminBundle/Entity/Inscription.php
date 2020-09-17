<?php

namespace Faculte\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 *
 * @ORM\Table(name="inscription")
 * @ORM\Entity(repositoryClass="Faculte\AdminBundle\Repository\InscriptionRepository")
 */
class Inscription
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;
    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="integer")
     */
    private $cin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DatedeNaissance", type="date")
     */
    private $DatedeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="Numerodetelephone", type="string", length=255)
     */
    private $Numerodetelephone;

    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", length=255)
     */
    private $profession;

    /**
     * @var string
     *
     * @ORM\Column(name="Niveaudetude", type="string", length=255)
     */
    private $Niveaudetude;


    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Inscription
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
     * @return Inscription
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
     * Set cin
     *
     * @param integer $cin
     *
     * @return Inscription
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return integer
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set datedeNaissance
     *
     * @param \DateTime $datedeNaissance
     *
     * @return Inscription
     */
    public function setDatedeNaissance($datedeNaissance)
    {
        $this->DatedeNaissance = $datedeNaissance;

        return $this;
    }

    /**
     * Get datedeNaissance
     *
     * @return \DateTime
     */
    public function getDatedeNaissance()
    {
        return $this->DatedeNaissance;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Inscription
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
     * Set numerodetelephone
     *
     * @param string $numerodetelephone
     *
     * @return Inscription
     */
    public function setNumerodetelephone($numerodetelephone)
    {
        $this->Numerodetelephone = $numerodetelephone;

        return $this;
    }

    /**
     * Get numerodetelephone
     *
     * @return string
     */
    public function getNumerodetelephone()
    {
        return $this->Numerodetelephone;
    }

    /**
     * Set profession
     *
     * @param string $profession
     *
     * @return Inscription
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set niveaudetude
     *
     * @param string $niveaudetude
     *
     * @return Inscription
     */
    public function setNiveaudetude($niveaudetude)
    {
        $this->Niveaudetude = $niveaudetude;

        return $this;
    }

    /**
     * Get niveaudetude
     *
     * @return string
     */
    public function getNiveaudetude()
    {
        return $this->Niveaudetude;
    }

    /**
     * Set user
     *
     * @param \Faculte\AdminBundle\Entity\User $user
     *
     * @return Inscription
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
}
