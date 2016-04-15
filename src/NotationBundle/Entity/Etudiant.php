<?php

namespace NotationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="NotationBundle\Repository\personneRepository")
 */
class Etudiant
{

    //ajout de la collection dans le constructeur
    public function __construct()
    {
        $this->session = new ArrayCollection();
    }

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
     *
     *
     * @ORM\ManyToMany(targetEntity="Session", mappedBy="etudiant")
     */
    private  $session;


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
     * @return personne
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
     * Add session
     *
     * @param \NotationBundle\Entity\Session $session
     * @return Etudiant
     */
    public function addSession(\NotationBundle\Entity\Session $session)
    {
        $this->session[] = $session;

        return $this;
    }

    /**
     * Remove session
     *
     * @param \NotationBundle\Entity\Session $session
     */
    public function removeSession(\NotationBundle\Entity\Session $session)
    {
        $this->session->removeElement($session);
    }

    /**
     * Get session
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSession()
    {
        return $this->session;
    }
}
