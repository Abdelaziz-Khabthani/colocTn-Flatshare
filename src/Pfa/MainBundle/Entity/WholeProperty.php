<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * cette classe représente un bien entier
 */

/**
 * WholeProperty
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pfa\MainBundle\Entity\WholePropertyRepository")
 */
class WholeProperty extends Property
{
    const TYPE = "WHOLE_PROPERTY";
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
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (($this->getMaximumStay() != 0) && ($this->getMinimumStay() > $this->getMaximumStay()))
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
     * Set price
     *
     * @param integer $price
     *
     * @return WholeProperty
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
}
