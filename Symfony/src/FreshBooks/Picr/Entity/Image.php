<?php

namespace FreshBooks\Picr\Entity;

class Image
{
  protected $file;
  protected $dateTime;

  public function getFile()
  {
    return $this->file;
  }
  public function setFile($file)
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
}
