<?php

namespace Faculte\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Niveau
 *
 * @ORM\Table(name="niveau")
 * @ORM\Entity(repositoryClass="Faculte\AdminBundle\Repository\NiveauRepository")
 */
class Niveau
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
     * @ORM\Column(name="numero_niveau", type="string", length=255)
     */
    private $numeroNiveau;

    /**
     * @ORM\ManyToOne(targetEntity="Filiere", inversedBy="niveau")
     * @ORM\JoinColumn(name="filiere_id", referencedColumnName="id")
     */
    private $filiere;

    /**
     * @ORM\OneToMany(targetEntity="Groupe", mappedBy="niveau",cascade={"remove"})
     *
     */
    private $groupes;


    /**
     * @ORM\OneToMany(targetEntity="Resultat", mappedBy="niveau",cascade={"remove"})
     *
     */
    private $resultats;

    /**
     * @ORM\ManyToMany(targetEntity="Matiere", mappedBy="niveaux",cascade={"remove"})
     **/
    protected $matieres;



    /**
     * @ORM\ManyToMany(targetEntity="Cour", mappedBy="niveaux",cascade={"remove"})
     **/
    protected $cours;

    /**
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getNumeroNiveau();

    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->resultats = new \Doctrine\Common\Collections\ArrayCollection();
        $this->matieres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cours = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set numeroNiveau
     *
     * @param string $numeroNiveau
     *
     * @return Niveau
     */
    public function setNumeroNiveau($numeroNiveau)
    {
        $this->numeroNiveau = $numeroNiveau;

        return $this;
    }

    /**
     * Get numeroNiveau
     *
     * @return string
     */
    public function getNumeroNiveau()
    {
        return $this->numeroNiveau;
    }

    /**
     * Set filiere
     *
     * @param \Faculte\AdminBundle\Entity\Filiere $filiere
     *
     * @return Niveau
     */
    public function setFiliere(\Faculte\AdminBundle\Entity\Filiere $filiere = null)
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere
     *
     * @return \Faculte\AdminBundle\Entity\Filiere
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Add groupe
     *
     * @param \Faculte\AdminBundle\Entity\Groupe $groupe
     *
     * @return Niveau
     */
    public function addGroupe(\Faculte\AdminBundle\Entity\Groupe $groupe)
    {
        $this->groupes[] = $groupe;

        return $this;
    }

    /**
     * Remove groupe
     *
     * @param \Faculte\AdminBundle\Entity\Groupe $groupe
     */
    public function removeGroupe(\Faculte\AdminBundle\Entity\Groupe $groupe)
    {
        $this->groupes->removeElement($groupe);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupes()
    {
        return $this->groupes;
    }

    /**
     * Add resultat
     *
     * @param \Faculte\AdminBundle\Entity\Resultat $resultat
     *
     * @return Niveau
     */
    public function addResultat(\Faculte\AdminBundle\Entity\Resultat $resultat)
    {
        $this->resultats[] = $resultat;

        return $this;
    }

    /**
     * Remove resultat
     *
     * @param \Faculte\AdminBundle\Entity\Resultat $resultat
     */
    public function removeResultat(\Faculte\AdminBundle\Entity\Resultat $resultat)
    {
        $this->resultats->removeElement($resultat);
    }

    /**
     * Get resultats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResultats()
    {
        return $this->resultats;
    }

    /**
     * Add matiere
     *
     * @param \Faculte\AdminBundle\Entity\Matiere $matiere
     *
     * @return Niveau
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

    /**
     * Add cour
     *
     * @param \Faculte\AdminBundle\Entity\Cour $cour
     *
     * @return Niveau
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
}
