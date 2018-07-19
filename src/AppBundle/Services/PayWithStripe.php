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
    /**
     * @param Request $request
     * @param Reservation $reservation
     * @param Transaction $transaction
     * @return bool
     */
    public function useStripe(Request $request, Reservation $reservation, Transaction $transaction)
    {
        \Stripe\Stripe::setApiKey("sk_test_qHjRSqkcpdP6N7Y8SfVPM79H");
        // recuperation du token
        $token = $request->get('stripeToken');
        // creation du client
            try {
                $charge =\Stripe\Charge::create(array(
                    "amount" => $reservation->getPriceToPay()*100,
                    "currency" => "eur",
                    "source" =>  $token, // obtained with Stripe.js
                    "description" =>  $reservation->getEmail()
                ));
            } catch (Card $e){ // test avec carte 4100000000000019
                $message = $transaction->setMessage($e->getMessage());
                $statusCode = $transaction->setStatusCode($e->getHttpStatus());
                $charge = \Stripe\Charge::all();
                $idStripe = $charge['data'][0]['id'];
                $idStripe = $transaction->setIdStripe($idStripe);
                //echo "vous avez un probleme avec votre carte !"; // mettre un message flash
                return false;
            } catch (Exception $e) { // token utilise deux fois
                // mettre un message d'erreur en flash
                // faire une redirection
                $message = $transaction->setMessage($e->getMessage());
                // $message = $transaction->setMessage("Probleme avec la transaction");
                $charge = \Stripe\Charge::all();
                $idStripe = $transaction->setIdStripe($charge['data'][0]['id']);
                //echo "il y a eu un probleme de transaction !"; // mettre un message flash
                return false;
            }
           $charge = \Stripe\Charge::all();
            $idStripe = $charge['data'][0]['id'];
            $message = $transaction->setMessage("Transaction reussie");
            $idStripe = $transaction->setIdStripe($idStripe);
            $statusCode = $transaction->setStatusCode("200");
            $this->sendEmail->sendEmail($reservation);
    }
}