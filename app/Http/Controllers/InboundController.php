<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    		$number = str_replace('+1', '', $_GET['From']);
				$body = strtoupper(str_replace("'", '', $_GET['Body']));
				$sender_is_contact = false;

				// Check if incoming SMS is from a stored contact
				if (\App\Contact::where('mobile', $number)->count() > 0) {
					$sender_is_contact = true;
				}

				// Reply to inbound SMS from unknown user
				if ($sender_is_contact == false) {
					$twiml = new Twilio\Twiml();
					$twiml->message()->body('Please visit www.link-sling.com to set up your account.');
					$response = Response::make($twiml, 200);
					$response->header('Content-Type', 'text/xml');

					return $response;
				}

				// Reply to inbound SMS from a stored contact
				if ($sender_is_contact == true) {
					
					// Authenticate contacts who accept agreement to receive messages
					if ($body == 'YES' && ( \App\Contact::where('mobile', $number)->first()->authorized == 0 || 2) ) {
						foreach (\App\Contact::where('mobile', $number)->get() as $do) {
							$contact = \App\Contact::where('mobile', $number)->first();
							$contact->authorized = 1;
							$contact->save();
						}

						$messages = \App\Message::where('mobile', $number)->get();

						foreach ($messages as $message) {
							$client = new Twilio\Rest\Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));

							$message->is_received = true;
							$message->save();

            	            $message = $client->messages->create(
            	                $number, // Text this number
            	                array(
            	                    'from' => env('TWILIO_NUMBER'), // From a valid Twilio number
            	                    'body' => $message->link . " | Sent By Link-Sling User: " . $message->sender_name
            	                )
            	            );
        		        }
					}

					// Set authorization to opt out for contact that declines messages
					else if ($body == 'NO') {
						foreach (\App\Contact::where('mobile', $number)->get() as $do) {
							$contact = \App\Contact::where('mobile', $number)->first();
							$contact->authorized = 2;
							$contact->save();
						}

						$twiml = new Twilio\Twiml();
						$twiml->message()->body("You have opted out of receiving messages from Link-Sling. It may take some time before you stop receiving ALL messages. To opt back in, you may reply with 'Yes' at any time.");
						$response = Response::make($twiml, 200);
						$response->header('Content-Type', 'text/xml');

						return $response;
					}

					// Reply to default sender that sent invalid response
					else if (\App\Contact::where('mobile', $number)->first()->authorized == 0) {
						$twiml = new Twilio\Twiml();
						$twiml->message()->body("www.link-sling.com has detected an invalid Response. Please reply with 'Yes' or 'No'");
						$response = Response::make($twiml, 200);
						$response->header('Content-Type', 'text/xml');

						return $response;
					}

					// Reply to authorized sender sending anything other than YES or NO
					else if (\App\Contact::where('mobile', $number)->first()->authorized == 1) {
						$twiml = new Twilio\Twiml();
						$twiml->message()->body("We do not accept incoming messages. Please visit www.link-sling.com to send your links via Link-Sling. Thank you!");
						$response = Response::make($twiml, 200);
						$response->header('Content-Type', 'text/xml');

						return $response;
					}

					// Reply to opted out sender sending anything other than YES or NO
					else if (\App\Contact::where('mobile', $number)->first()->authorized == 2) {
						$twiml = new Twilio\Twiml();
						$twiml->message()->body("You have opted out of receiving messages from Link-Sling. To authorize us to send you messages, please reply with 'Yes'");
						$response = Response::make($twiml, 200);
						$response->header('Content-Type', 'text/xml');

						return $response;
					}
				}
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
