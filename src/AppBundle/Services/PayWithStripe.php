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
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PayWithStripe
{
    private $sendEmail;
    public function __construct ($sendEmail)
    {
        $this->sendEmail = $sendEmail;
    }
    public function useStripe(Request $request,Reservation $reservation, Transaction $transaction)
    {
        \Stripe\Stripe::setApiKey("sk_test_qHjRSqkcpdP6N7Y8SfVPM79H");
        // recuperation du token
        $token = $_POST['stripeToken'];
        // creation du client
            try {
                $charge =\Stripe\Charge::create(array(
                    "amount" => $reservation->getPriceToPay()*100,
                    "currency" => "eur",
                    "source" =>  $token, // obtained with Stripe.js
                    "description" =>  $reservation->getEmail()
                ));

            } catch (Exception $e) {
                // mettre un message d'erreur en flash
                // faire une redirection
                $message = $transaction->setMessage("Probleme avec la transaction");
                $charge = \Stripe\Charge::all();
                $idStripe = $transaction->setIdStripe($charge['data'][0]['id']);
                return false;
            }
        $charge = \Stripe\Charge::all();
        $message = $transaction->setMessage("Transaction enregistrée dans Stripe");
        $idStripe = $transaction->setIdStripe($charge['data'][0]['id']);
        $this->sendEmail->sendEmail($reservation);

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