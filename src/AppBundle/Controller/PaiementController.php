<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaiementController extends Controller
{
    public function paiementAction(Request $request)
    {
    /*    $user=$this->getUser();
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
       \Stripe\Stripe::setApiKey("vlujgzmhcq3JSFEOvsbiofse6bqufDnvombcqzmcqcqvblbdvbqkHqbziucd3549QCSl");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        // Create a Customer:
        $customer = \Stripe\Customer::create(array(
            "email" => $user->getMail(),
            "source" => $token,
        ));

        // Charge the Customer instead of the card:
        $charge = \Stripe\Charge::create(array(
            "amount" => 1000,
            "currency" => "eur",
            "customer" => $customer->id
        ));

        // YOUR CODE: Save the customer ID and other info in a database for later.

        // YOUR CODE (LATER): When it's time to charge the customer again, retrieve the customer ID.
        $charge = \Stripe\Charge::create(array(
            "amount" => 1500, // $15.00 this time
            "currency" => "eur",
            "customer" => $user->getId()
        ));
        */
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_61ZXppa5eIGSpJ9VfTwSYDHU");
        
        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        $name = $_POST['name'];
        
        if(filter_var($this->getUser()->getEmail(),FILTER_VALIDATE_EMAIL) && !empty($name) && !empty($token)){
            $ch = curl_init();
            $data= [
                'source'=> $token,
                'name' => $name,
                'email'=> $this->getUser()->getEmail()
            ];
            
            curl_setopt_array($ch,[
                CURLOP_URL => 'https://api.stripe.com/v1/customers',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_USERPWD => 'sk_test_61ZXppa5eIGSpJ9VfTwSYDHU',
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_POSTFIELDS => http_build_query($data),
            ]);
            
            $response = json_decode(curl_exec($ch));
            curl_close($ch);
                
        }
        
        $charge = \Stripe\Charge::create([
            'amount' => 999,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);
        
        
    }
}
