<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * cette classe représente une/des chambre(s) annoncer par:
 *         - le propriétaire du bien
 *         - un étudiant qui veut partager son bien (cherche un collocatair) pratiquemant méme s'il cherche collocataire il est entrain de louer des chambre vide dans son bien 
 */

/**
 * Room
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pfa\MainBundle\Entity\RoomRepository")
 */
class Room extends Property
{
    const TYPE = "ROOM";
    /**
     * @var \Pfa\MainBundle\Entity\AdvertiserType
     *
     * @ORM\ManyToOne(targetEntity="Pfa\MainBundle\Entity\AdvertiserType")
     * 
     * @Assert\NotBlank(message = "Ce champ doit pas etre vide")
     * @Assert\Valid
     */
    private $advertiserType;

    /**
     * @var integer
     * 
     * @ORM\Column(name="number_current_mate", type="integer")
     * 
     * @Assert\NotBlank(message = "Nombre de collocataire courrant est invalide")
     * @Assert\Range(
     *      min = 0,
     *      max = 10,
     *      minMessage = "Nombre de collocataire courrant est invalide",
     *      maxMessage = "Nombre de collocataire courrant est invalide",
     *      invalidMessage = "Nombre de collocataire courrant est invalide"
     * )
     */
    private $numberOfCurrentMate;

    /**
     * @var integer
     * 
     * @ORM\Column(name="number_rooms_to_rent", type="integer")
     * 
     * @Assert\NotBlank(message = "Nombre des chambres a louer est invalide")
     * @Assert\Range(
     *      min = 1,
     *      max = 10,
     *      minMessage = "Nombre des chambres a louer est invalide",
     *      maxMessage = "Nombre des chambres a louer est invalide",
     *      invalidMessage = "Nombre des chambres a louer est invalide"
     * )
     */
    private $numberOfRoomsToRent;

    /**
     * @var \Pfa\MainBundle\Entity\Preference
     *
     * @ORM\OneToOne(targetEntity="Pfa\MainBundle\Entity\Preference", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * 
     * @Assert\Valid
     */
    private $selfPreference;

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->getNumberOfTotalRooms() < $this->getNumberOfRoomsToRent())
        {
            
            $context->buildViolation('Nombre Total des chambres doit etre superieur au nombre des chambres a louer.')
                ->atPath('numberOfTotalRooms')
                ->addViolation();
        }
        else if(($this->getNumberOfCurrentMate() > 1) && ($this->getSelfPreference()->getAgeSolo() != null))
        {
            $context->buildViolation('Erreure au des preference des collocataires.')
                ->atPath('selfPreference')
                ->addViolation();
        }
        else if(($this->getNumberOfCurrentMate() == 1) && ($this->getSelfPreference()->getAgeSolo() == null))
        {
            $context->buildViolation('Erreure au des preference des collocataires.')
                ->atPath('selfPreference')
                ->addViolation();
        }
        
        if (($this->getMaximumStay() != 0) && (intval($this->getMinimumStay()) > intval($this->getMaximumStay())))
        {    
            $context->buildViolation('Periode minimum doit étre superieur a periode de laisser.')
                ->atPath('maximumStay')
                ->addViolation();
        }

        if ($this->getTargetPreference()->getAgeSolo() != null)
        {
            $context->buildViolation('Erreur au niveau des preference')
                ->atPath('targetPreference')
                ->addViolation();
        }
    }

    /**
     * Set numberOfCurrentMate
     *
     * @param integer $numberOfCurrentMate
     *
     * @return Room
     */
    public function setNumberOfCurrentMate($numberOfCurrentMate)
    {
        $this->numberOfCurrentMate = $numberOfCurrentMate;

        return $this;
    }

    /**
     * Get numberOfCurrentMate
     *
     * @return integer
     */
    public function getNumberOfCurrentMate()
    {
        return $this->numberOfCurrentMate;
    }

    /**
     * Set numberOfRoomsToRent
     *
     * @param integer $numberOfRoomsToRent
     *
     * @return Room
     */
    public function setNumberOfRoomsToRent($numberOfRoomsToRent)
    {
        $this->numberOfRoomsToRent = $numberOfRoomsToRent;

        return $this;
    }

    /**
     * Get numberOfRoomsToRent
     *
     * @return integer
     */
    public function getNumberOfRoomsToRent()
    {
        return $this->numberOfRoomsToRent;
    }

    /**
     * Set advertiserType
     *
     * @param \Pfa\MainBundle\Entity\AdvertiserType $advertiserType
     *
     * @return Room
     */
    public function setAdvertiserType(\Pfa\MainBundle\Entity\AdvertiserType $advertiserType = null)
    {
        $this->advertiserType = $advertiserType;

        return $this;
    }

    /**
     * Get advertiserType
     *
     * @return \Pfa\MainBundle\Entity\AdvertiserType
     */
    public function getAdvertiserType()
    {
        return $this->advertiserType;
    }

    /**
     * Set selfPreference
     *
     * @param mixed $selfPreference
     *
     * @return Room
     */
    public function setSelfPreference(\Pfa\MainBundle\Entity\Preference $selfPreference = null)
    {
        $this->selfPreference = $selfPreference;

        return $this;
    }

    /**
     * Get selfPreference
     *
     * @return \Pfa\MainBundle\Entity\Preference
     */
    public function getSelfPreference()
    {
        return $this->selfPreference;
    }
}
