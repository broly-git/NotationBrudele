<?php

namespace NotationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 *
 * @ORM\Table(name="session")
 * @ORM\Entity(repositoryClass="NotationBundle\Repository\SessionRepository")
 */
class Session
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
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;
    
    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="personne", inversedBy="session")
     * @ORM\JoinColumn(name="enseignant_id", referencedColumnName="id")
     */
    private $enseignant;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="Etudiant", inversedBy="session")
     * @ORM\JoinColumn(name="etudiant_id", referencedColumnName="id")
     */
    private $etudiant;
    
    

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
     * Set intitule
     *
     * @param string $intitule
     * @return Session
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Session
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Session
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set enseignant
     *
     * @param \NotationBundle\Entity\personne $enseignant
     * @return Session
     */
    public function setEnseignant(\NotationBundle\Entity\personne $enseignant = null)
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    /**
     * Get enseignant
     *
     * @return \NotationBundle\Entity\personne 
     */
    public function getEnseignant()
    {
        return $this->enseignant;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etudiant = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add etudiant
     *
     * @param \NotationBundle\Entity\personne $etudiant
     * @return Session
     */
    public function addEtudiant(\NotationBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiant[] = $etudiant;

        return $this;
    }

    /**
     * Remove etudiant
     *
     * @param \NotationBundle\Entity\personne $etudiant
     */
    public function removeEtudiant(\NotationBundle\Entity\personne $etudiant)
    {
        $this->etudiant->removeElement($etudiant);
    }

    /**
     * Get etudiant
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }


   
}
