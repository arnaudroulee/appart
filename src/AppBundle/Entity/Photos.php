<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photos
 */
class Photos
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var integer
     */
    private $principale;

    /**
     * @var \DateTime
     */
    private $dateCreation;

    /**
     * @var integer
     */
    private $active;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idAppartements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idAppartements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Photos
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set principale
     *
     * @param integer $principale
     * @return Photos
     */
    public function setPrincipale($principale)
    {
        $this->principale = $principale;

        return $this;
    }

    /**
     * Get principale
     *
     * @return integer 
     */
    public function getPrincipale()
    {
        return $this->principale;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Photos
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return Photos
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
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
     * Add idAppartements
     *
     * @param \AppBundle\Entity\Appartements $idAppartements
     * @return Photos
     */
    public function addIdAppartement(\AppBundle\Entity\Appartements $idAppartements)
    {
        $this->idAppartements[] = $idAppartements;

        return $this;
    }

    /**
     * Remove idAppartements
     *
     * @param \AppBundle\Entity\Appartements $idAppartements
     */
    public function removeIdAppartement(\AppBundle\Entity\Appartements $idAppartements)
    {
        $this->idAppartements->removeElement($idAppartements);
    }

    /**
     * Get idAppartements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdAppartements()
    {
        return $this->idAppartements;
    }
}
