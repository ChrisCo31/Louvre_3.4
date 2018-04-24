<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 23/04/2018
 * Time: 18:19
 */

namespace AppBundle\Services;


use AppBundle\Entity\Reservation;
use AppBundle\Entity\Transaction;
use Symfony\Component\HttpFoundation\Response;

class PayWithStripe
{
    public function useStripe(Reservation $reservation)
    {
        \Stripe\Stripe::setApiKey("sk_test_qHjRSqkcpdP6N7Y8SfVPM79H");
        // recuperation du token
        $token = $_POST['stripeToken'];
        // creation du client
        $charge =\Stripe\Charge::create(array(
            "amount" => $reservation->getPriceToPay()*100,
            "currency" => "eur",
            "source" =>  $token, // obtained with Stripe.js
            "description" =>  $reservation->getEmail()
        ));
    }
    public function useCharge(Transaction $transaction)
    {
        $response = new Response();
        $statusCode = $transaction->setStatusCode($response->getStatusCode());
        $charge = \Stripe\Charge::all();
        $idStripe = $transaction->setIdStripe($charge['data'][0]['id']);
        $status = (substr($response->getStatusCode(), 0,1));
        if($status == 2) {
            //$sendEmail = $this->get('app.SendEmail');
            //$sendEmail->createEmail();
            $message = $transaction->setMessage("OK"); // Comment recuperer l'attribut StatusText de l'objet Response? (création d'une classe qui herite de la
            //classe Response avec une méthode get StatusText)
            //$this->get('session')->getFlashBag()->add('warning', $this->get('translator')->trans('Warning.Flash.Identification'));
        }
        elseif($status == 4){
            $message = $transaction->setMessage("request issue");
        }
        elseif($status == 5){
            $message = $transaction->setMessage("server error");
        }
        else{
            $message = $transaction->setMessage("unknown error");
        }
    }
}