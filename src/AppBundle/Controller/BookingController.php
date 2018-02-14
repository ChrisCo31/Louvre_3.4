<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 14/02/2018
 * Time: 14:56
 */

namespace AppBundle\Controller;


class BookingController
{
    public function indexAction()
    {
        // appel du template
        $content = $this->get('templating')->render('AppBundle:Blog:index.html.twig', array('listArticle' => array()
        ));
        return new Response($content);
    }
}