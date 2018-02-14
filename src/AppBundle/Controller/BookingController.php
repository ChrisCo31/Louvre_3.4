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
    public function indexAction()
    {
        return new Response("La page du choix de la langue");
    }

}