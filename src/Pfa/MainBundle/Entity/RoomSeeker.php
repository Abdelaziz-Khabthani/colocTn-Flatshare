<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * cette classe représente les "chercheur d'une collocation".
 */

/**
 * RoomSeeker
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pfa\MainBundle\Entity\RoomSeekerRepository")
 */
class RoomSeeker extends Advert
{
    const TYPE = "ROOM_SEEKER";
    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_seekers", type="integer")
     * 
     * @Assert\NotBlank(message = "Nombre des collocataire invalide")
     * @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      minMessage = "Nombre des collocataire invalide",
     *      maxMessage = "Nombre des collocataire invalide",
     *      invalidMessage = "Nombre des collocataire invalide"
     * )
     */
    private $numberOfSeekers;

    /**
     * @var float
     * 
     * @ORM\Column(name="radius", type="float")
     * @Assert\NotBlank(message = "radius invalide")
     * @Assert\Range(
     *      min = 1,
     *      max = 30,
     *      minMessage = "radius invalide",
     *      maxMessage = "radius invalide",
     *      invalidMessage = "radius invalide"
     * )
     */
    private $radius;

    /**
     * @var integer
     * 
     * @ORM\Column(name="periode_to_stay", type="integer", nullable = true)
     * 
     * @Assert\Range(
     *      min = 0,
     *      max = 12,
     *      minMessage = "Periode invalide",
     *      maxMessage = "Periode invalide",
     *      invalidMessage = "Periode invalide"
     * )
     */
    private $periodeToStay;

    /**
     * @var integer
     * 
     * @ORM\Column(name="budget", type="integer")
     * @Assert\NotBlank(message = "Budget invalide")
     * @Assert\Range(
     *      min = 1,
     *      max = 9999,
     *      minMessage = "Budget invalide",
     *      maxMessage = "Budget invalide",
     *      invalidMessage = "Budget invalide"
     * )
     */
    private $budget;

    /**
     * @var \Pfa\MainBundle\Entity\Preference
     *
     * @ORM\OneToOne(targetEntity="Pfa\MainBundle\Entity\Preference", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $selfPreference;

    /**
     * @var \Pfa\SecurityBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="Pfa\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\Valid
     */
    private $advertiser;

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if(($this->getNumberOfSeekers() > 1) && ($this->getSelfPreference()->getAgeSolo() != null))
        {
            $context->buildViolation('Erreure au des preference du chercheur.')
                ->atPath('selfPreference')
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
     * Set numberOfSeekers
     *
     * @param integer $numberOfSeekers
     *
     * @return RoomSeeker
     */
    public function setNumberOfSeekers($numberOfSeekers)
    {
        $this->numberOfSeekers = $numberOfSeekers;

        return $this;
    }

    /**
     * Get numberOfSeekers
     *
     * @return integer
     */
    public function getNumberOfSeekers()
    {
        return $this->numberOfSeekers;
    }

    /**
     * Set periodeToStay
     *
     * @param integer $periodeToStay
     *
     * @return RoomSeeker
     */
    public function setPeriodeToStay($periodeToStay)
    {
        $this->periodeToStay = $periodeToStay;

        return $this;
    }

    /**
     * Get periodeToStay
     *
     * @return integer
     */
    public function getPeriodeToStay()
    {
        return $this->periodeToStay;
    }

    /**
     * Set budget
     *
     * @param integer $budget
     *
     * @return RoomSeeker
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return integer
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set radius
     *
     * @param float $radius
     *
     * @return RoomSeeker
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;

        return $this;
    }

    /**
     * Get radius
     *
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Set selfPreference
     *
     * @param \Pfa\MainBundle\Entity\Preference $selfPreference
     *
     * @return RoomSeeker
     */
    public function setSelfPreference(\Pfa\MainBundle\Entity\Preference $selfPreference)
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

    /**
     * Set advertiser
     *
     * @param \Pfa\SecurityBundle\Entity\User $advertiser
     *
     * @return RoomSeeker
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
