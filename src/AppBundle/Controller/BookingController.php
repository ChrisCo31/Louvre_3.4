<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 14/02/2018
 * Time: 16:56
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $content = $this->get('templating')->render('AppBundle:Booking:index.html.twig');
        return new Response ($content);
    }

}