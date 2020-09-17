<?php

namespace Faculte\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbsenceEtd
 *
 * @ORM\Table(name="absence_etd")
 * @ORM\Entity(repositoryClass="Faculte\AdminBundle\Repository\AbsenceEtdRepository")
 */
class AbsenceEtd
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
     * @ORM\Column(name="nbAbsence", type="string", length=255)
     */
    private $nbAbsence;

    /**
     * @ORM\ManyToOne(targetEntity="Etudiant", inversedBy="absence_etd")
     * @ORM\JoinColumn(name="etudiant_id", referencedColumnName="id")
     */
    private $etudiant;

    /**
     * @ORM\ManyToOne(targetEntity="Matiere", inversedBy="absence_etd")
     * @ORM\JoinColumn(name="matiere_id", referencedColumnName="id")
     */
    private $matiere;





    /*******************************************************/
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nbAbsence
     *
     * @param string $nbAbsence
     *
     * @return AbsenceEtd
     */
    public function setNbAbsence($nbAbsence)
    {
        $this->nbAbsence = $nbAbsence;

        return $this;
    }

    /**
     * Get nbAbsence
     *
     * @return string
     */
    public function getNbAbsence()
    {
        return $this->nbAbsence;
    }




    /**
     * Set etudiant
     *
     * @param \Faculte\AdminBundle\Entity\Etudiant $etudiant
     *
     * @return AbsenceEtd
     */
    public function setEtudiant(\Faculte\AdminBundle\Entity\Etudiant $etudiant = null)
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * Get etudiant
     *
     * @return \Faculte\AdminBundle\Entity\Etudiant
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * Set matiere
     *
     * @param \Faculte\AdminBundle\Entity\Matiere $matiere
     *
     * @return AbsenceEtd
     */
    public function setMatiere(\Faculte\AdminBundle\Entity\Matiere $matiere = null)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return \Faculte\AdminBundle\Entity\Matiere
     */
    public function getMatiere()
    {
        return $this->matiere;
    }
}
