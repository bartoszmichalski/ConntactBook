<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="houseNumber", type="string", length=255, nullable=true)
     */
    private $houseNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="flatNumber", type="string", length=255, nullable=true)
     */
    private $flatNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Conntact", inversedBy="addresses")
     */
    private $conntact;

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
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set houseNumber
     *
     * @param string $houseNumber
     * @return Address
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return string 
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set flatNumber
     *
     * @param string $flatNumber
     * @return Address
     */
    public function setFlatNumber($flatNumber)
    {
        $this->flatNumber = $flatNumber;

        return $this;
    }

    /**
     * Get flatNumber
     *
     * @return string 
     */
    public function getFlatNumber()
    {
        return $this->flatNumber;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Address
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
     * Set conntact
     *
     * @param \AppBundle\Entity\Conntact $conntact
     * @return Address
     */
    public function setConntact(\AppBundle\Entity\Conntact $conntact = null)
    {
        $this->conntact = $conntact;
        return $this;
    }

    /**
     * Get conntact
     *
     * @return \AppBundle\Entity\Conntact 
     */
    public function getConntact()
    {
        return $this->conntact;
    }
}
