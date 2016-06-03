<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * cette clase regroupe les attributs communes entre la classe "Room" et "WholeProperty"
 */

/**
 * Property
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap( {"room" = "Room", "whole_property" = "WholeProperty"} )
 */
abstract class Property extends Advert
{
    /**
     * @var \Pfa\MainBundle\Entity\PropertyType
     *
     * @ORM\ManyToOne(targetEntity="Pfa\MainBundle\Entity\PropertyType")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\NotBlank(message = "Ce champ doit pas etre vide")
     * @Assert\Valid
     */
    private $propertyType;

    /**
     * @var string
     * 
     * @ORM\Column(name="street", type="string", length=255)
     * 
     * @Assert\NotBlank(message = "Ce champ doit pas etre vide")
     * 
     */
    private $street;

    /**
     * @var string
     * 
     * @ORM\Column(name="postcode", type="string", length=255)
     * 
     * @Assert\NotBlank(message = "Ce champ doit pas etre vide")
     * @Assert\Regex(
     *     pattern = "/^[0-9]*$/",
     *     message = "Code postal invalid de l'annonce est invalide."
     * )
     * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      exactMessage = "Code postale invalide."
     * )
     */
    private $postcode;

    /**
     * @var integer
     * 
     * @ORM\Column(name="minimum_stay", type="integer")
     * 
     * 
     * @Assert\NotBlank(message = "Ce champ doit pas etre vide")
     * @Assert\Range(
     *      min = 1,
     *      max = 12,
     *      minMessage = "Valeur minimum {{ limit }} est invalide",
     *      maxMessage = "Valeur minimum {{ limit }} est invalide",
     *      invalidMessage = "Periode invalide"
     * )
     */
    private $minimumStay;

    /**
     * @var integer
     * 
     * @ORM\Column(name="maximum_stay", type="integer")
     * 
     * @Assert\NotBlank(message = "Ce champ doit pas etre vide")
     * @Assert\Range(
     *      min = 0,
     *      max = 12,
     *      minMessage = "Periode maximum {{ limit }} est invalide",
     *      maxMessage = "Periode maximum {{ limit }} est invalide",
     *      invalidMessage = "Periode invalide"
     * )
     */
    private $maximumStay;


    /**
     * @var integer
     *
     * @ORM\Column(name="number_total_rooms", type="integer")
     * 
     * @Assert\NotBlank(message = "Nombre des chambres doit pas etre vide")
     * @Assert\Range(
     *      min = 1,
     *      max = 10,
     *      minMessage = "Nombre des chambres {{ limit }} est invalide",
     *      maxMessage = "Nombre des chambres {{ limit }} est invalide"
     * )
     */
    private $numberOfTotalRooms;

    /**
     * Alwayse execute addRoomsInformation() to maintain the order
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pfa\MainBundle\Entity\RoomInformation", mappedBy="property", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid
     */
    private $roomsInformations;

    /**
     * @var boolean
     *
     * @ORM\Column(name="facture_free", type="boolean")
     */
    private $factureFree;

    /**
     * @var \Pfa\SecurityBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Pfa\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @assert\Valid
     */
    private $advertiser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roomsInformations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add roomsInformation
     *
     * @param \Pfa\MainBundle\Entity\RoomInformation $roomsInformation
     *
     * @return Room
     */
    public function addRoomsInformation(\Pfa\MainBundle\Entity\RoomInformation $roomsInformation)
    {
        $this->roomsInformations[] = $roomsInformation;
        $roomsInformation->setProperty($this);
        return $this;
    }

    /**
     * Remove roomsInformation
     *
     * @param \Pfa\MainBundle\Entity\RoomInformation $roomsInformation
     */
    public function removeRoomsInformation(\Pfa\MainBundle\Entity\RoomInformation $roomsInformation)
    {
        $this->roomsInformations->removeElement($roomsInformation);
    }

    public function resetRoomsInformation()
    {
        foreach ($this->roomsInformations->toArray() as $room) {
            $this->removeRoomsInformation($room);
        }
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Property
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
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Property
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set minimumStay
     *
     * @param integer $minimumStay
     *
     * @return Property
     */
    public function setMinimumStay($minimumStay)
    {
        $this->minimumStay = $minimumStay;

        return $this;
    }

    /**
     * Get minimumStay
     *
     * @return integer
     */
    public function getMinimumStay()
    {
        return $this->minimumStay;
    }

    /**
     * Set maximumStay
     *
     * @param integer $maximumStay
     *
     * @return Property
     */
    public function setMaximumStay($maximumStay)
    {
        $this->maximumStay = $maximumStay;

        return $this;
    }

    /**
     * Get maximumStay
     *
     * @return integer
     */
    public function getMaximumStay()
    {
        return $this->maximumStay;
    }

    /**
     * Set numberOfTotalRooms
     *
     * @param integer $numberOfTotalRooms
     *
     * @return Property
     */
    public function setNumberOfTotalRooms($numberOfTotalRooms)
    {
        $this->numberOfTotalRooms = $numberOfTotalRooms;

        return $this;
    }

    /**
     * Get numberOfTotalRooms
     *
     * @return integer
     */
    public function getNumberOfTotalRooms()
    {
        return $this->numberOfTotalRooms;
    }

    /**
     * Set propertyType
     *
     * @param \Pfa\MainBundle\Entity\PropertyType $propertyType
     *
     * @return Property
     */
    public function setPropertyType(\Pfa\MainBundle\Entity\PropertyType $propertyType)
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    /**
     * Get propertyType
     *
     * @return \Pfa\MainBundle\Entity\PropertyType
     */
    public function getPropertyType()
    {
        return $this->propertyType;
    }

    /**
     * Get roomsInformations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoomsInformations()
    {
        return $this->roomsInformations;
    }

    /**
     * Set factureFree
     *
     * @param boolean $factureFree
     *
     * @return Property
     */
    public function setFactureFree($factureFree)
    {
        $this->factureFree = $factureFree;

        return $this;
    }

    /**
     * Get factureFree
     *
     * @return boolean
     */
    public function getFactureFree()
    {
        return $this->factureFree;
    }

    /**
     * Set advertiser
     *
     * @param \Pfa\SecurityBundle\Entity\User $advertiser
     *
     * @return Property
     */
    public function setAdvertiser(\Pfa\SecurityBundle\Entity\User $advertiser)
    {
        $this->advertiser = $advertiser;

        return $this;
    }

    /**
     * Get advertiser
     *
     * @return \Pfa\SecurityBundle\Entity\User
     */
    public function getAdvertiser()
    {
        return $this->advertiser;
    }
}
