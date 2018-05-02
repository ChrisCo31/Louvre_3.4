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
use Stripe\Error\Card;
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

            }catch (Card $e){
                $message = $transaction->setMessage("Probleme carte");
                echo "carte !";
                var_dump($e);
                return false;
            } catch (Exception $e) {
                // mettre un message d'erreur en flash
                // faire une redirection
                $message = $transaction->setMessage("Probleme avec la transaction");
                $charge = \Stripe\Charge::all();
                $idStripe = $transaction->setIdStripe($charge['data'][0]['id']);

                return false;
            }

            $charge = \Stripe\Charge::all();
            $idStripe = $charge['data'][0]['id'];


            $message = $transaction->setMessage("Transaction enregistrée dans Stripe");
            $idStripe = $transaction->setIdStripe($idStripe);
            $this->sendEmail->sendEmail($reservation);

    }
}