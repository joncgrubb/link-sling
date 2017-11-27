<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Twilio;
use Carbon\Carbon;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
     * Display a table of sent messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
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
        // Get form inputs
        $number = Input::get('recipient');
        $link = Input::get('link');
         
        // Create an authenticated client for the Twilio API
        $client = new Twilio\Rest\Client($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);

        $message = $client->messages->create(
            $number, // Text this number
            array(
                'from' => $_ENV['TWILIO_NUMBER'], // From a valid Twilio number
                'body' => $link . " | Sent By: " . \Auth::user()->name
            )
        );

        $msg_db = new \App\Message;
        $msg_db->twilio_SID = $message->sid;
        $msg_db->sender_id = \Auth::user()->id;
        $msg_db->mobile = $number;
        $msg_db->link = $link;
        $msg_db->sent_at = Carbon::now();
        $msg_db->save();

        // print $message->sid;
        return redirect('/home');
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
