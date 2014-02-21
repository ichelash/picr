<?php

namespace FreshBooks\Picr\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FreshBooks\Picr\Entity\Image;

class RecentController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {

      $em = $this->getDoctrine()->getManager();
      $query = $em->createQuery(
          'SELECT i
          FROM FreshBooksPicrBundle:Image i
          ORDER BY i.dateTime DESC'
      )->setMaxResults(20);

      $images = $query->getResult();

      return array(
        'images' => $images,
      );
    }
}
