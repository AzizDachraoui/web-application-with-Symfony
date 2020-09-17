<?php

namespace Faculte\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="Enseignant")
 * @ORM\Entity(repositoryClass="Faculte\AdminBundle\Repository\EnseignantRepository")
 */
class Enseignant
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
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="votre nom ne peut pas contenir des numéro"
     * )
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="votre nom ne peut pas contenir des numéro"
     * )
     */
    private $prenom;


    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=255)
     */
    private $specialite;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=255)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string")
     * @Assert\Type(type="numeric", message="Ce champ ne peut pas contenir des caractéres alphabetique.")
     */
    private $telephone;

    /**
     * @var date
     *
     * @ORM\Column(name="DateNaissance", type="date")
     */
    private $dateNaissance;

    /*************************************************/

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\OneToMany(targetEntity="Cour", mappedBy="enseignant",cascade={"remove"})
     *
     */
    private $cours;

    /**
     * @ORM\ManyToMany(targetEntity="Matiere", mappedBy="enseignants")
     **/
    protected $matieres;


    /**
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getNom();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->demanderattrapages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Enseignant
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
     * @return Enseignant
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
     * Set specialite
     *
     * @param string $specialite
     *
     * @return Enseignant
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return Enseignant
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Enseignant
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
     * Set ville
     *
     * @param string $ville
     *
     * @return Enseignant
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Enseignant
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
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Enseignant
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
     * Set user
     *
     * @param \Faculte\AdminBundle\Entity\User $user
     *
     * @return Enseignant
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
     * Add cour
     *
     * @param \Faculte\AdminBundle\Entity\Cour $cour
     *
     * @return Enseignant
     */
    public function addCour(\Faculte\AdminBundle\Entity\Cour $cour)
    {
        $this->cours[] = $cour;

        return $this;
    }

    /**
     * Remove cour
     *
     * @param \Faculte\AdminBundle\Entity\Cour $cour
     */
    public function removeCour(\Faculte\AdminBundle\Entity\Cour $cour)
    {
        $this->cours->removeElement($cour);
    }

    /**
     * Get cours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * Add demanderattrapage
     *
     * @param \Faculte\AdminBundle\Entity\DemandeRattrapage $demanderattrapage
     *
     * @return Enseignant
     */
    public function addDemanderattrapage(\Faculte\AdminBundle\Entity\DemandeRattrapage $demanderattrapage)
    {
        $this->demanderattrapages[] = $demanderattrapage;

        return $this;
    }

    /**
     * Remove demanderattrapage
     *
     * @param \Faculte\AdminBundle\Entity\DemandeRattrapage $demanderattrapage
     */
    public function removeDemanderattrapage(\Faculte\AdminBundle\Entity\DemandeRattrapage $demanderattrapage)
    {
        $this->demanderattrapages->removeElement($demanderattrapage);
    }

    /**
     * Get demanderattrapages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemanderattrapages()
    {
        return $this->demanderattrapages;
    }

    /**
     * Add matiere
     *
     * @param \Faculte\AdminBundle\Entity\Matiere $matiere
     *
     * @return Enseignant
     */
    public function addMatiere(\Faculte\AdminBundle\Entity\Matiere $matiere)
    {
        $this->matieres[] = $matiere;

        return $this;
    }

    /**
     * Remove matiere
     *
     * @param \Faculte\AdminBundle\Entity\Matiere $matiere
     */
    public function removeMatiere(\Faculte\AdminBundle\Entity\Matiere $matiere)
    {
        $this->matieres->removeElement($matiere);
    }

    /**
     * Get matieres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatieres()
    {
        return $this->matieres;
    }
}
