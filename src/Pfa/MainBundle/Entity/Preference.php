<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * cette classe représente
 *     - les preferences des étudiants qui ont déja un bien et qui veulent le partager avec d'autres
 *     - les préférences des étudiants cible
 */

/**
 * Preference
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Preference
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
     * @var boolean
     * 
     * @ORM\Column(name="pet", type="boolean")
     */
    private $pet;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="smocker", type="boolean")
     */
    private $smocker;

    /**
     * @var \Pfa\MainBundle\Entity\Gender
     *
     * @ORM\ManyToOne(targetEntity="Pfa\MainBundle\Entity\Gender")
     * @ORM\JoinColumn(nullable=true)
     * 
     * @assert\Valid
     */
    private $gender;

    /**
     * @var integer
     *
     * @Assert\Range(
     *      min = 18,
     *      max = 99,
     *      minMessage = "Votre age est invalide",
     *      maxMessage = "Votre age est invalide",
     *      invalidMessage = "Votre age est invalide"
     * )
     * 
     * @ORM\Column(name="age_solo", type="integer", nullable=true)
     */
    private $ageSolo;

    /**
     * @var integer
     *
     * @Assert\Range(
     *      min = 18,
     *      max = 99,
     *      minMessage = "Votre age est invalide",
     *      maxMessage = "Votre age est invalide",
     *      invalidMessage = "Votre age est invalide"
     * )
     * 
     * @ORM\Column(name="age_min", type="integer", nullable=true)
     */
    private $ageMin;

    /**
     * @var integer
     * 
     * @Assert\Range(
     *      min = 18,
     *      max = 99,
     *      minMessage = "Votre age est invalide",
     *      maxMessage = "Votre age est invalide",
     *      invalidMessage = "Votre age est invalide"
     * )
     *
     * @ORM\Column(name="age_max", type="integer", nullable=true)
     */
    private $ageMax;

    /**
     * @var array
     * 
     * @Assert\All({
     *     @Assert\NotBlank
     * })
     *
     * @ORM\Column(name="universities", type="array")
     */
    private $universities;

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->getAgeMin() > $this->getAgeMax())
        {
            $context->buildViolation('Age maximum doit étre superieur au age minimum')
                ->atPath('ageMax')
                ->addViolation();
        }
    }

    /**
     * Set ageMax
     *
     * @param integer $ageMax
     *
     * @return Preference
     */
    public function setAgeMax($ageMax)
    {
        $this->ageMax = $ageMax;

        return $this;
    }

    /**
     * Get ageMax
     *
     * @return integer
     */
    public function getAgeMax()
    {
        return $this->ageMax;
    }

    /**
     * Set universities
     *
     * @param array $universities
     *
     * @return Preference
     */
    public function setUniversities($universities)
    {
        $this->universities = $universities;

        return $this;
    }

    /**
     * Get universities
     *
     * @return array
     */
    public function getUniversities()
    {
        return $this->universities;
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
     * Set pet
     *
     * @param boolean $pet
     *
     * @return Preference
     */
    public function setPet($pet)
    {
        $this->pet = $pet;

        return $this;
    }

    /**
     * Get pet
     *
     * @return boolean
     */
    public function getPet()
    {
        return $this->pet;
    }

    /**
     * Set smocker
     *
     * @param boolean $smocker
     *
     * @return Preference
     */
    public function setSmocker($smocker)
    {
        $this->smocker = $smocker;

        return $this;
    }

    /**
     * Get smocker
     *
     * @return boolean
     */
    public function getSmocker()
    {
        return $this->smocker;
    }

    /**
     * Set gender
     *
     * @param \Pfa\MainBundle\Entity\Gender $gender
     *
     * @return Preference
     */
    public function setGender(\Pfa\MainBundle\Entity\Gender $gender = null)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return \Pfa\MainBundle\Entity\Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set ageSolo
     *
     * @param integer $ageSolo
     *
     * @return Preference
     */
    public function setAgeSolo($ageSolo)
    {
        $this->ageSolo = $ageSolo;

        return $this;
    }

    /**
     * Get ageSolo
     *
     * @return integer
     */
    public function getAgeSolo()
    {
        return $this->ageSolo;
    }

    /**
     * Set ageMin
     *
     * @param integer $ageMin
     *
     * @return Preference
     */
    public function setAgeMin($ageMin)
    {
        $this->ageMin = $ageMin;

        return $this;
    }

    /**
     * Get ageMin
     *
     * @return integer
     */
    public function getAgeMin()
    {
        return $this->ageMin;
    }
}
