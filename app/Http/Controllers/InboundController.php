<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio;
use Response;

class InboundController extends Controller
{
    /**
     * Reply to inbound phonecalls.
     *
     * @return \Illuminate\Http\Response
     */
    public function inboundCALL()
    {
        $twiml = new Twilio\Twiml();
			  $twiml->say('Greetings from Link Sling. To begin using our service simply create an account on link sling dot com. Thank you.', array('voice' => 'alice'));
			  $response = Response::make($twiml, 200);
			  $response->header('Content-Type', 'text/xml');

			  return $response;
    }

    /**
     * Reply to inbound SMS.
     *
     * @return \Illuminate\Http\Response
     */
    public function inboundSMS()
    {
    		$number = $_GET['From'];
				$body = $_GET['Body'];

				// Handle unkown users texting the Link-Sling number


    		$twiml = new Twilio\Twiml();
				$twiml->message()->body('This is a reply from Link-Sling!');
				// $twiml->redirect('https://demo.twilio.com/sms/welcome');
				$response = Response::make($twiml, 200);
				$response->header('Content-Type', 'text/xml');

				return $response;
    }
}
