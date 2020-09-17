<?php

namespace Faculte\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity(repositoryClass="Faculte\AdminBundle\Repository\GroupeRepository")
 */
class Groupe
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
     * @ORM\Column(name="numGroupe", type="string", length=255)
     */
    private $numGroupe;
    /**
     * @ORM\ManyToOne(targetEntity="Niveau", inversedBy="groupe")
     * @ORM\JoinColumn(name="niveau_id", referencedColumnName="id")
     */
    private $niveau;
    /**
     * @ORM\OneToMany(targetEntity="Etudiant", mappedBy="groupe",cascade={"remove"})
     *
     */
    private $etudiants;
    /**
     * @ORM\OneToMany(targetEntity="EmploiTemps", mappedBy="groupe",cascade={"remove"})
     *
     */
    private $emploistemps;



    /**
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getNumGroupe();

    }




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etudiants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emploistemps = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set numGroupe
     *
     * @param string $numGroupe
     *
     * @return Groupe
     */
    public function setNumGroupe($numGroupe)
    {
        $this->numGroupe = $numGroupe;

        return $this;
    }

    /**
     * Get numGroupe
     *
     * @return string
     */
    public function getNumGroupe()
    {
        return $this->numGroupe;
    }

    /**
     * Set niveau
     *
     * @param \Faculte\AdminBundle\Entity\Niveau $niveau
     *
     * @return Groupe
     */
    public function setNiveau(\Faculte\AdminBundle\Entity\Niveau $niveau = null)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \Faculte\AdminBundle\Entity\Niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Add etudiant
     *
     * @param \Faculte\AdminBundle\Entity\Etudiant $etudiant
     *
     * @return Groupe
     */
    public function addEtudiant(\Faculte\AdminBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiants[] = $etudiant;

        return $this;
    }

    /**
     * Remove etudiant
     *
     * @param \Faculte\AdminBundle\Entity\Etudiant $etudiant
     */
    public function removeEtudiant(\Faculte\AdminBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiants->removeElement($etudiant);
    }

    /**
     * Get etudiants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtudiants()
    {
        return $this->etudiants;
    }

    /**
     * Add emploistemp
     *
     * @param \Faculte\AdminBundle\Entity\EmploiTemps $emploistemp
     *
     * @return Groupe
     */
    public function addEmploistemp(\Faculte\AdminBundle\Entity\EmploiTemps $emploistemp)
    {
        $this->emploistemps[] = $emploistemp;

        return $this;
    }

    /**
     * Remove emploistemp
     *
     * @param \Faculte\AdminBundle\Entity\EmploiTemps $emploistemp
     */
    public function removeEmploistemp(\Faculte\AdminBundle\Entity\EmploiTemps $emploistemp)
    {
        $this->emploistemps->removeElement($emploistemp);
    }

    /**
     * Get emploistemps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmploistemps()
    {
        return $this->emploistemps;
    }
}
