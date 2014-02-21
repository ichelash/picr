<?php

namespace FreshBooks\Picr\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FreshBooks\Picr\Entity\Image;

class UploadController extends Controller
{

  /**
   * @Template()
   */
  public function indexAction(Request $request)
  {
    $image = new Image();
    $image->setDateTime(new \DateTime('now'));

    $form = $this->createFormBuilder($image)
      ->add('file', 'file')
      ->add('save', 'submit', array(
          'attr' => array(
            'class' => 'btn btn-lg btn-primary btn-block',
            'disabled' => 'disabled',
          ),
        ))
      ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
      $image = $form->getData();
      $image->upload();

      return $this->redirect($this->generateUrl('_about'));
    }

    return array(
      'form' => $form->createView(),
    );
  }
}
