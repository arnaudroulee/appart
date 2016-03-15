<?php

namespace Appart\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Appart\AdminBundle\Repository\UserRepository")
 * @UniqueEntity("email", message="fos_user.email.invalid", groups={"Registration", "Profile"})
 */
class User extends BaseUser
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     * @ORM\JoinTable(name="users_groups")
     */
    protected $groups;

    /**
     *
     * @var type 
     * @Assert\NotBlank(message="fos_user.password.blank", groups={"RegistrationSite", "ProfileSite"})
     */
    protected $firstname;

    /**
     *
     * @var type 
     * @Assert\NotBlank(message="fos_user.password.blank", groups={"RegistrationSite", "ProfileSite"})
     */
    protected $lastname;

    /**
     *
     * @var type 
     * @Assert\NotBlank(message="fos_user.password.blank", groups={"Registration", "ProfileSite"})
     */
    protected $phone;

    /**
     * @var Gallery
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Appartement", mappedBy="user", cascade={"persist"})
     */
    protected $appartements;

    public function __construct()
    {
        parent::__construct();

        $this->username = 'username';

        $this->appartements = new ArrayCollection();
    }

    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    /**
     * Add appartements
     *
     * @param \AppBundle\Entity\Appartement $appartements
     * @return User
     */
    public function addAppartement(\AppBundle\Entity\Appartement $appartements)
    {
        $this->appartements[] = $appartements;

        $appartements->setUser($this);

        return $this;
    }

    /**
     * Remove appartements
     *
     * @param \AppBundle\Entity\Appartement $appartements
     */
    public function removeAppartement(\AppBundle\Entity\Appartement $appartements)
    {
        $this->appartements->removeElement($appartements);
    }

    /**
     * Get appartements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppartements()
    {
        return $this->appartements;
    }

}
