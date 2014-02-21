<?php

namespace FreshBooks\Picr\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FreshBooks\Picr\Entity\Image;

class UploadController extends Controller
{

  public function ajaxUploadAction() {
    $request = $this->get('request');
    $files = $request->files;

    $imageShowPaths = array();

    foreach ($files as $uploadedFile) {
      $image = new Image($uploadedFile);
      $image->setDateTime(new \DateTime('now'));
      $image->upload();

      try {
        $em = $this->getDoctrine()->getManager();
        $em->persist($image);
        $em->flush();

      } catch (\Doctrine\DBAL\DBALException $e) {
        // Doctrine sucks and I can't access the PDOException... Assume an error
        // is a DUPLICATE PRIMARY and suppress this exception. Redirect to the 
        // original upload below.
      }

      $imageShowPaths[] = $this->generateUrl('_show', array('image' => $image->getId()));
    }

    $response = new JsonResponse();
    $response->setData($imageShowPaths);
    return $response;
  }

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

      try {
        $em = $this->getDoctrine()->getManager();
        $em->persist($image);
        $em->flush();
      } catch (\Doctrine\DBAL\DBALException $e) {
        // Doctrine sucks and I can't access the PDOException... Assume an error
        // is a DUPLICATE PRIMARY and suppress this exception. Redirect to the 
        // original upload below.
      }

      return $this->redirect($this->generateUrl(
        '_show',
        array('image' => $image->getId())
      ));
    }

    return array(
      'form' => $form->createView(),
    );
  }

  /**
   * @Template()
   */
  public function showAction($image)
  {
    $em = $this->getDoctrine()->getManager();
    $imageObj = $em->find("FreshBooks\Picr\Entity\Image", $image);

    return array(
      'image' => $imageObj,
    );
  }
}
