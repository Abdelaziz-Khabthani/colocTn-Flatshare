<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * La classe Annonce qui contient tous les attributs communes entre les classes "Property" 
 * et "RoomSeeker"
 */

/**
 * Advert
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pfa\MainBundle\Entity\AdvertRepository")
 * @ORM\InheritanceType("JOINED") 
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap( {"property" = "Property", "roomseeker" = "RoomSeeker"} )
 */
abstract class Advert
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
     * @var float
     * 
     * @ORM\Column(name="gmap_lat", type="float")
     */
    private $gmapLat;

    /**
     * @var float
     * 
     * @ORM\Column(name="gmap_lng", type="float")
     */
    private $gmapLng;

    /**
     * @var string
     *
     * @ORM\Column(name="advert_title", type="string", length=255)
     * @Assert\NotBlank(message = "Titre doit pas étre vide")
     * @Assert\Regex(
     *     pattern = "/^[(a-z)(0-9)zàâçéèêëîïôûùüÿñæœ .-]+$/i",
     *     message = "Titre erroné, il faut que le titre soit des charactere alphanumérique"
     * )
     */
    private $advertTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="advert_description", type="text")
     * @Assert\NotBlank(message = "Description doit pas ére vide")
     */
    private $advertDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="advertiser_phone", type="string", length=255)
     * @Assert\NotBlank(message = "Numéro de telephone doit pas etre vide.")
     * @Assert\Regex(
     *     pattern = "/^[0-9]*$/",
     *     message = "Numéro du teléphone erroné."
     * )
     * @Assert\Length(
     *     min = 8,
     *     max = 8,
     *     exactMessage = "Numéro du teléphone erroné"
     * )
     */
    private $advertiserPhone;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="feature_tv", type="boolean")
     */
    private $featureTv;

    /**
     * @var \Pfa\MainBundle\Entity\Town
     *
     * @ORM\ManyToOne(targetEntity="Pfa\MainBundle\Entity\Town")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\NotBlank(message = "Ville doit pas etre vide")
     * @Assert\Valid
     */
    private $town;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="feature_garden_terrace", type="boolean")
     */
    private $featureGardenTerrace;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="feature_parcking", type="boolean")
     */
    private $featureParcking;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="feature_furnished", type="boolean")
     */
    private $featureFurnished;

    /**
     * @var boolean
     *
     * @ORM\Column(name="feature_wifi", type="boolean")
     */
    private $featureWifi;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="featured", type="boolean", nullable = true)
     */
    private $featured;

    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer", nullable = true)
     */
    private $views;

    /**
     * @var \Pfa\MainBundle\Entity\Preference
     *
     * @ORM\OneToOne(targetEntity="Pfa\MainBundle\Entity\Preference", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\Valid
     */
    private $targetPreference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_date", type="datetime")
     * 
     * @Assert\Date()
     */
    private $postDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="available_date", type="datetime")
     * 
     * @Assert\Date(message = "Date Invalide")
     * @Assert\NotBlank(message = "Ce champ doit pas etre vide")
     */
    private $availableDate;

    /**
     * @var \Pfa\MainBundle\Entity\Album
     * 
     * @ORM\OneToOne(targetEntity="Pfa\MainBundle\Entity\Album", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    private $album;

    /**
     * Constructor
     */
    public function __construct()
    {
        $views = 0;
        $featured = false;
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
     * Set gmapLat
     *
     * @param float $gmapLat
     *
     * @return Property
     */
    public function setGmapLat($gmapLat)
    {
        $this->gmapLat = $gmapLat;

        return $this;
    }

    /**
     * Get gmapLat
     *
     * @return float
     */
    public function getGmapLat()
    {
        return $this->gmapLat;
    }

    /**
     * Set gmapLng
     *
     * @param float $gmapLng
     *
     * @return Property
     */
    public function setGmapLng($gmapLng)
    {
        $this->gmapLng = $gmapLng;

        return $this;
    }

    /**
     * Get gmapLng
     *
     * @return float
     */
    public function getGmapLng()
    {
        return $this->gmapLng;
    }

    /**
     * Set advertTitle
     *
     * @param string $advertTitle
     *
     * @return Advert
     */
    public function setAdvertTitle($advertTitle)
    {
        $this->advertTitle = $advertTitle;

        return $this;
    }

    /**
     * Get advertTitle
     *
     * @return string
     */
    public function getAdvertTitle()
    {
        return $this->advertTitle;
    }

    /**
     * Set advertDescription
     *
     * @param string $advertDescription
     *
     * @return Advert
     */
    public function setAdvertDescription($advertDescription)
    {
        $this->advertDescription = $advertDescription;

        return $this;
    }

    /**
     * Get advertDescription
     *
     * @return string
     */
    public function getAdvertDescription()
    {
        return $this->advertDescription;
    }

    /**
     * Set advertiserPhone
     *
     * @param string $advertiserPhone
     *
     * @return Advert
     */
    public function setAdvertiserPhone($advertiserPhone)
    {
        $this->advertiserPhone = $advertiserPhone;

        return $this;
    }

    /**
     * Get advertiserPhone
     *
     * @return string
     */
    public function getAdvertiserPhone()
    {
        return $this->advertiserPhone;
    }

    /**
     * Set featureTv
     *
     * @param boolean $featureTv
     *
     * @return Advert
     */
    public function setFeatureTv($featureTv)
    {
        $this->featureTv = $featureTv;

        return $this;
    }

    /**
     * Get featureTv
     *
     * @return boolean
     */
    public function getFeatureTv()
    {
        return $this->featureTv;
    }

    /**
     * Set featureGardenTerrace
     *
     * @param boolean $featureGardenTerrace
     *
     * @return Advert
     */
    public function setFeatureGardenTerrace($featureGardenTerrace)
    {
        $this->featureGardenTerrace = $featureGardenTerrace;

        return $this;
    }

    /**
     * Get featureGardenTerrace
     *
     * @return boolean
     */
    public function getFeatureGardenTerrace()
    {
        return $this->featureGardenTerrace;
    }

    /**
     * Set featureParcking
     *
     * @param boolean $featureParcking
     *
     * @return Advert
     */
    public function setFeatureParcking($featureParcking)
    {
        $this->featureParcking = $featureParcking;

        return $this;
    }

    /**
     * Get featureParcking
     *
     * @return boolean
     */
    public function getFeatureParcking()
    {
        return $this->featureParcking;
    }

    /**
     * Set featureFurnished
     *
     * @param boolean $featureFurnished
     *
     * @return Advert
     */
    public function setFeatureFurnished($featureFurnished)
    {
        $this->featureFurnished = $featureFurnished;

        return $this;
    }

    /**
     * Get featureFurnished
     *
     * @return boolean
     */
    public function getFeatureFurnished()
    {
        return $this->featureFurnished;
    }

    /**
     * Set featureWifi
     *
     * @param boolean $featureWifi
     *
     * @return Advert
     */
    public function setFeatureWifi($featureWifi)
    {
        $this->featureWifi = $featureWifi;

        return $this;
    }

    /**
     * Get featureWifi
     *
     * @return boolean
     */
    public function getFeatureWifi()
    {
        return $this->featureWifi;
    }

    /**
     * Set featured
     *
     * @param boolean $featured
     *
     * @return Advert
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     *
     * @return Advert
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set town
     *
     * @param \Pfa\MainBundle\Entity\Town $town
     *
     * @return Advert
     */
    public function setTown(\Pfa\MainBundle\Entity\Town $town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return \Pfa\MainBundle\Entity\Town
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set targetPreference
     *
     * @param \Pfa\MainBundle\Entity\Preference $targetPreference
     *
     * @return Advert
     */
    public function setTargetPreference(\Pfa\MainBundle\Entity\Preference $targetPreference)
    {
        $this->targetPreference = $targetPreference;

        return $this;
    }

    /**
     * Get targetPreference
     *
     * @return \Pfa\MainBundle\Entity\Preference
     */
    public function getTargetPreference()
    {
        return $this->targetPreference;
    }

    /**
     * Set availableDate
     *
     * @param \DateTime $availableDate
     *
     * @return Advert
     */
    public function setAvailableDate($availableDate)
    {
        $this->availableDate = $availableDate;

        return $this;
    }

    /**
     * Get availableDate
     *
     * @return \DateTime
     */
    public function getAvailableDate()
    {
        return $this->availableDate;
    }

    /**
     * Set album
     *
     * @param \Pfa\MainBundle\Entity\Album $album
     * @return Advert
     */
    public function setAlbum(\Pfa\MainBundle\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \Pfa\MainBundle\Entity\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set views
     *
     * @param integer $views
     *
     * @return Advert
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer
     */
    public function getViews()
    {
        return $this->views;
    }
}
