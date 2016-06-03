<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * listes des villes tunisienne
 */

/**
 * Town
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Town
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
     * @Assert\Choice(choices = {"Ariana","Béja","Ben Arous","Bizert","Gabés","Gafsa","Jendouba","Kairouane","Kébili","Kef","Mahdia","La Manouba","Médenine","Monastir","Nabeul","Sfax","Sidi Bouzid","Siliana","Sousse","Tatouine","Tozeur","Tunis","Zaghouan"}, message = "Choisissez une ville valide.")
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
     * @return Town
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
