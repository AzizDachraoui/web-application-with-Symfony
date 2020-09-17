<?php

namespace Faculte\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Filiere
 *
 * @ORM\Table(name="filiere")
 * @ORM\Entity(repositoryClass="Faculte\AdminBundle\Repository\FiliereRepository")
 */
class Filiere
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
     * @ORM\OneToMany(targetEntity="Niveau", mappedBy="filiere",cascade={"remove"})
     *
     */
    private $niveaux;

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
        $this->niveaux = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Filiere
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
     * Add niveaux
     *
     * @param \Faculte\AdminBundle\Entity\Niveau $niveaux
     *
     * @return Filiere
     */
    public function addNiveaux(\Faculte\AdminBundle\Entity\Niveau $niveaux)
    {
        $this->niveaux[] = $niveaux;

        return $this;
    }

    /**
     * Remove niveaux
     *
     * @param \Faculte\AdminBundle\Entity\Niveau $niveaux
     */
    public function removeNiveaux(\Faculte\AdminBundle\Entity\Niveau $niveaux)
    {
        $this->niveaux->removeElement($niveaux);
    }

    /**
     * Get niveaux
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiveaux()
    {
        return $this->niveaux;
    }
}
