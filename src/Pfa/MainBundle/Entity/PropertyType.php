<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * cette classe représente les différents type d'un bien:
 *     - appartemant
 *     - maison
 *     - studio
 *     - etc..
 */

/**
 * PropertyType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PropertyType
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
     * @var string
     * 
     * @assert\NotBlank(message = "Type de propriété doit pas étre vide")
     * @Assert\Choice(choices = {"Appartemant", "Villa", "Studio"}, message = "Choisissez un type de propriété valide.")
     * 
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

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
     *
     * @return PropertyType
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
}
