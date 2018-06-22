<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 22/04/2018
 * Time: 22:18
 */

namespace AppBundle\Services;


use AppBundle\Entity\Reservation;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\Translator;


class SendEmail
{
    private $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, $translator)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->translator = $translator;

    }
    public function sendEmail (Reservation $reservation)
    {
        $reservation->getToken();
        $reservation->getDateReservation();
        $reservation->getnbTicket();
        $reservation->getpriceToPay();
        $subject = $this->translator->trans('Booking.Mail.Subject');
        $from = 'coeuranger.pastel@gmail.com';
        $to = $reservation->getEmail();
        $format = 'text/html';
        $body = $this->templating->render(
            'AppBundle:Emails:registration.html.twig', array(
                'reservation'=>$reservation,
                'tickets' =>$reservation->getTickets()
            ));
        $this->createEmail($subject, $from, $to, $format, $body);

    }
    public function createEmail($subject, $from, $to, $format, $body)
    {
         $message = \Swift_Message::newInstance()
              ->setSubject($subject)
              ->setFrom($from)
              ->setTo($to)
              ->setContentType($format)
              ->setBody($body);
         $this->mailer->send($message);
    }


}