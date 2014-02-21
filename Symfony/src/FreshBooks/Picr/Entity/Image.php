<?php

namespace FreshBooks\Picr\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Image
{

  /**
   * @ORM\Column(type="string", nullable=false)
   * @ORM\Id
   */
  protected $id;

  /**
   * @ORM\Column(type="datetime")
   */
  protected $dateTime;

  protected $file;

  function __construct(UploadedFile $file = null) {
    if ($file !== null) {
      $this->setFile($file);
    }
  }

  public function upload()
  {
    // the file property can be empty if the field is not required
    if (null === $this->getFile()) {
      return;
    }

    $newName = sha1_file($this->file->getPathname()) . '.' . $this->getFile()->guessExtension();

    // move takes the target directory and then the
    // target filename to move to
    $this->getFile()->move(
      $this->getUploadRootDir(),
      $newName
    );

    // set the path property to the filename where you've saved the file
    $this->id = $newName;

    // clean up the file property as you won't need it anymore
    $this->file = null;
  }

  public function getAbsolutePath()
  {
    return null === $this->id
      ? null
      : $this->getUploadRootDir().'/'.$this->id;
  }

  public function getWebPath()
  {
    return null === $this->id
      ? null
      : $this->getUploadDir().'/'.$this->id;
  }

  protected function getUploadRootDir()
  {
    // the absolute directory path where uploaded
    // documents should be saved
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
  }

  protected function getUploadDir()
  {
    // get rid of the __DIR__ so it doesn't screw up
    // when displaying uploaded doc/image in the view.
    return 'uploads';
  }

  public function getFile()
  {
    return $this->file;
  }

  public function setFile(UploadedFile $file = null)
  {
    $this->file = $file;
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
   * Set dateTime
   *
   * @param \DateTime $dateTime
   * @return Image
   */
  public function setDateTime($dateTime)
  {
    $this->dateTime = $dateTime;

    return $this;
  }

  /**
   * Get dateTime
   *
   * @return \DateTime 
   */
  public function getDateTime()
  {
    return $this->dateTime;
  }
}
