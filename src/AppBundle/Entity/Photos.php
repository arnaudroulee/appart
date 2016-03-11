<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photos
 *
 * @ORM\Table(name="photos")
 * @ORM\Entity
 */
class Photos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="appartement_id", type="integer", nullable=false)
     */
    private $appartementId;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    private $path;

    /**
     * @var integer
     *
     * @ORM\Column(name="principale", type="integer", nullable=false)
     */
    private $principale;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=false)
     */
    private $dateCreation;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active;

    /**
     * @var \AppBundle\Entity\Appartements
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Appartements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;



    /**
     * Set appartementId
     *
     * @param integer $appartementId
     * @return Photos
     */
    public function setAppartementId($appartementId)
    {
        $this->appartementId = $appartementId;

        return $this;
    }

    /**
     * Get appartementId
     *
     * @return integer 
     */
    public function getAppartementId()
    {
        return $this->appartementId;
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
     * Set id
     *
     * @param \AppBundle\Entity\Appartements $id
     * @return Photos
     */
    public function setId(\AppBundle\Entity\Appartements $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return \AppBundle\Entity\Appartements 
     */
    public function getId()
    {
        return $this->id;
    }
}
