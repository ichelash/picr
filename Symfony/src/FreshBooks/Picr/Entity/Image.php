<?php

namespace FreshBooks\Picr\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image
{
  protected $file;
  protected $dateTime;
  protected $name;
  protected $path;

  public function getFile()
  {
    return $this->file;
  }

  public function setFile(UploadedFile $file = null)
  {
    $this->file = $file;
  }

  public function getDateTime()
  {
    return $this->dateTime;
  }

  public function setDateTime(\DateTime $dateTime = null)
  {
    $this->dateTime = $dateTime;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    $this->name;
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
    $this->path = $newName;

    // clean up the file property as you won't need it anymore
    $this->file = null;
  }

  public function getAbsolutePath()
  {
    return null === $this->path
      ? null
      : $this->getUploadRootDir().'/'.$this->path;
  }

  public function getWebPath()
  {
    return null === $this->path
      ? null
      : $this->getUploadDir().'/'.$this->path;
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
    return 'uploads/';
  }
}
