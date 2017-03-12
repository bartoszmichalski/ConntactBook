<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Conntact
 *
 * @ORM\Table(name="conntact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConntactRepository")
 */
class Conntact
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Address", mappedBy="conntact")
     */
    private $addresses;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Phone", mappedBy="conntact")
     */
    private $phones;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Email", mappedBy="conntact")
     */
    private $emailAddresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->phones = new ArrayCollection();
        $this->$emailAddresses = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Conntact
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Conntact
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Conntact
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add addresses
     *
     * @param \AppBundle\Entity\Address $addresses
     * @return Conntact
     */
    public function addAddress(\AppBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \AppBundle\Entity\Address $addresses
     */
    public function removeAddress(\AppBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add phones
     *
     * @param \AppBundle\Entity\Phone $phones
     * @return Conntact
     */
    public function addPhone(\AppBundle\Entity\Phone $phones)
    {
        $this->phones[] = $phones;

        return $this;
    }

    /**
     * Remove phones
     *
     * @param \AppBundle\Entity\Phone $phones
     */
    public function removePhone(\AppBundle\Entity\Phone $phones)
    {
        $this->phones->removeElement($phones);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add emailAddresses
     *
     * @param \AppBundle\Entity\Email $emailAddresses
     * @return Conntact
     */
    public function addEmailAddress(\AppBundle\Entity\Email $emailAddresses)
    {
        $this->emailAddresses[] = $emailAddresses;

        return $this;
    }

    /**
     * Remove emailAddresses
     *
     * @param \AppBundle\Entity\Email $emailAddresses
     */
    public function removeEmailAddress(\AppBundle\Entity\Email $emailAddresses)
    {
        $this->emailAddresses->removeElement($emailAddresses);
    }

    /**
     * Get emailAddresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmailAddresses()
    {
        return $this->emailAddresses;
    }
}
