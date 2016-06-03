<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * cette classe contient les informations d'une chambre dans le cas d'une annonce "Room"
 */

/**
 * RoomInformationRoom
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RoomInformationRoom extends RoomInformation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     * 
     * @Assert\NotBlank(message = "Prix invalide")
     * @Assert\Range(
     *      min = 1,
     *      max = 9999,
     *      minMessage = "Prix invalide",
     *      maxMessage = "Prix invalide",
     *      invalidMessage = "Prix invalide"
     * )
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="already_one_there", type="boolean", nullable=true)
     */
    private $alreadyOneThere;  

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->getProperty()->getAdvertiserType()->getName() == "Propriétaire du bien" && $this->getAlreadyOneThere() == true)
        {
            $context->buildViolation('Erreure au niveau du formulaire')
                ->atPath('size')
                ->addViolation();
        }
        else if($this->getSize()->getName() == "Single" && $this->getAlreadyOneThere() == true)
        {
            $context->buildViolation('Erreure au niveau du formulaire')
                ->atPath('size')
                ->addViolation();
        }
    }  

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return RoomInformationRoom
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set alreadyOneThere
     *
     * @param boolean $alreadyOneThere
     *
     * @return RoomInformationRoom
     */
    public function setAlreadyOneThere($alreadyOneThere)
    {
        $this->alreadyOneThere = $alreadyOneThere;

        return $this;
    }

    /**
     * Get alreadyOneThere
     *
     * @return boolean
     */
    public function getAlreadyOneThere()
    {
        return $this->alreadyOneThere;
    }
}
