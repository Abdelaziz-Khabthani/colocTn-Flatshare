<?php

namespace Pfa\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     * @Assert\NotBlank(message = "nom doit pas étre vide")
     * @Assert\Regex(
     *     pattern = "/^[(a-z)]+$/i",
     *     message = "Il faut que le prenom soit des charactere alphabétiques"
     * )
     */
    protected $firstName;

        /**
        * @var string
        *
        * @ORM\Column(name="last_name", type="string", length=255)
        * @Assert\NotBlank(message = "prenom doit pas étre vide")
        * @Assert\Regex(
        *     pattern = "/^[(a-z)]+$/i",
        *     message = "Il faut que le prenom soit des charactere alphabétiques"
        * )
         */
    protected $lastName;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * 
     * @ORM\ManyToMany(targetEntity="Pfa\MainBundle\Entity\Advert")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $favoriteAdverts;

    public function __construct()
    {
        parent::__construct();
    }

    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }
    public function setEmailCanonical($emailCanonical)
    {
        $email = is_null($emailCanonical) ? '' : $emailCanonical;
        parent::setEmailCanonical($emailCanonical);
        $this->usernameCanonical = $emailCanonical;
        return $this;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Add favoriteAdvert
     *
     * @param \Pfa\MainBundle\Entity\Advert $favoriteAdvert
     *
     * @return User
     */
    public function addFavoriteAdvert(\Pfa\MainBundle\Entity\Advert $favoriteAdvert)
    {
        $this->favoriteAdverts[] = $favoriteAdvert;

        return $this;
    }

    /**
     * Remove favoriteAdvert
     *
     * @param \Pfa\MainBundle\Entity\Advert $favoriteAdvert
     */
    public function removeFavoriteAdvert(\Pfa\MainBundle\Entity\Advert $favoriteAdvert)
    {
        $this->favoriteAdverts->removeElement($favoriteAdvert);
    }

    /**
     * Get favoriteAdverts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavoriteAdverts()
    {
        return $this->favoriteAdverts;
    }
}
