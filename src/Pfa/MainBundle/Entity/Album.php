<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Album
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
     * @var File
     *
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="album", cascade={"persist", "remove"})
     *
     */
    private $photos;

    /**
     * @var ArrayCollection
     */
    private $uploadedFiles;

    public function __construct() {
        $this->photos = new ArrayCollection();
        $this->uploadedFiles = new ArrayCollection();
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

    public function getPhotos() {
        return $this->photos;
    }
    public function setPhotos(array $photos) {
        $this->photos = $photos;
    }

    /**
     * @return ArrayCollection
     */
    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }

    /**
     * @param ArrayCollection $uploadedFiles
     */
    public function setUploadedFiles($uploadedFiles)
    {
        $this->uploadedFiles = $uploadedFiles;
    }

    /**
     * @ORM\PreFlush()
     */
    public function upload()
    {
        foreach($this->uploadedFiles as $uploadedFile)
        {
            if ($uploadedFile) {
                $photo = new Photo($uploadedFile);

                $this->getPhotos()->add($photo);
                $photo->setAlbum($this);

                unset($uploadedFile);
            }
        }
    }
}
