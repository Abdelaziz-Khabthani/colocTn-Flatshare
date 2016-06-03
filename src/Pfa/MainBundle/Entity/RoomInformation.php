<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * cette classe contient les différentes informations d'une chambre
 * cette classe a 2 fils 
 *         - "RoomInformationWholeProperty" dans le cas d'une chambre appartien a une annonce "WholeProperty" (elle n'a pas de prix parceque le bien est louer entiéremant)
 *         - "RoomInformationRoom" dans le cas d'une chambre appartient a une annonce "Room"
 */

/**
 * RoomInformation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap( {"room_information_whole_property" = "RoomInformationWholeProperty", "room_information_room" = "RoomInformationRoom"} )
 */
abstract class RoomInformation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Pfa\MainBundle\Entity\RoomSize
     *
     * @ORM\ManyToOne(targetEntity="Pfa\MainBundle\Entity\RoomSize")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\NotBlank(message = "Ce champ doit pas etre vide")
     * @Assert\Valid
     */
    private $size;

    /**
     * @var \Pfa\MainBundle\Entity\Property
     *
     * @ORM\ManyToOne(targetEntity="Pfa\MainBundle\Entity\Property", inversedBy="roomsInformations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $property;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suite", type="boolean")
     */
    private $suite;

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
     * Set size
     *
     * @param \Pfa\MainBundle\Entity\RoomSize $size
     *
     * @return RoomInformation
     */
    public function setSize(\Pfa\MainBundle\Entity\RoomSize $size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return \Pfa\MainBundle\Entity\RoomSize
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set property
     *
     * @param \Pfa\MainBundle\Entity\Property $property
     *
     * @return RoomInformation
     */
    public function setProperty(\Pfa\MainBundle\Entity\Property $property)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get property
     *
     * @return \Pfa\MainBundle\Entity\Property
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set suite
     *
     * @param boolean $suite
     *
     * @return RoomInformation
     */
    public function setSuite($suite)
    {
        $this->suite = $suite;

        return $this;
    }

    /**
     * Get suite
     *
     * @return boolean
     */
    public function getSuite()
    {
        return $this->suite;
    }
}
