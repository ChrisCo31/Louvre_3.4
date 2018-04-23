<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 22/04/2018
 * Time: 22:18
 */

namespace AppBundle\Services;


use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class SendEmail
{
    public function CreateEmail($name, \Swift_Mailer $mailer){

        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('museedulouvre@museedulouvre.com')
            ->setTo('mishima.chris@hotmail.fr')
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'Emails/registration.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
        ;
        $mailer->send($message);
    }



}