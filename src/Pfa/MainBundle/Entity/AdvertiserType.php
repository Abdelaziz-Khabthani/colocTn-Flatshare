<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * cette classe représente les différents types d'annonceur pour le type "Room"
 *         - Un propriétaire du bien
 *         - Un loueur qui cherche avec qui partager son bien (Etudiant(s) qui cherche un colocataire) 
 * 
 */

/**
 * AdvertiserType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AdvertiserType
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank( message = "Ce champ doit pas etre vide")
     * @Assert\Choice(choices = {"Propriétaire du bien", "Etudiant (Collocation)"}, message = "Le type d'annonceur est incorect.")
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
     * @return AdvertiserType
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
