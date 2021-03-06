<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Twilio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $messages = \Auth::user()->sent()->orderBy('id', 'desc')->get();
        $contacts = \Auth::user()->historyContacts()->get();

        return view('messages.history', compact('messages', 'contacts'));
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
        $validatedData = $request->validate([
            'link' => 'required|string|max:255',
            'recipient' => 'required|string|exists:contacts,name',
        ]);

        $contactInput = Input::get('recipient');
        $number = \Auth::user()->contacts()->where('name', $contactInput)->where('owner', \Auth::user()->id)->first()->mobile;
        $link = Input::get('link');
        $contact = \Auth::user()->contacts()->where('name', $contactInput)->where('owner', \Auth::user()->id)->first();

        // Send authorization message to new contacts first
        if ($contact->authorized == 0) {
            $client = new Twilio\Rest\Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));

            $message = $client->messages->create(
                $number, // Text this number
                array(
                    'from' => env('TWILIO_NUMBER'), // From a valid Twilio number
                    'body' => \Auth::user()->name . " wants to send you a link with www.link-sling.com | Reply to this message with 'Yes' to allow Link-Sling to send you links or 'No' to opt out of receiving links from us."
                )
            );

            $msg_db = new \App\Message;
            $msg_db->twilio_SID = $message->sid;
            $msg_db->sender_id = \Auth::user()->id;
            $msg_db->sender_name = \Auth::user()->name;
            $msg_db->mobile = $number;
            $msg_db->link = $link;
            $msg_db->sent_at = Carbon::now();
            $msg_db->save();

            return redirect('/home');
        }

        if ($contact->authorized == 1) {
            $client = new Twilio\Rest\Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));

            $message = $client->messages->create(
                $number, // Text this number
                array(
                    'from' => env('TWILIO_NUMBER'), // From a valid Twilio number
                    'body' => $link . " | Sent By Link-Sling User: " . \Auth::user()->name
                )
            );

            $msg_db = new \App\Message;
            $msg_db->twilio_SID = $message->sid;
            $msg_db->sender_id = \Auth::user()->id;
            $msg_db->sender_name = \Auth::user()->name;
            $msg_db->mobile = $number;
            $msg_db->link = $link;
            $msg_db->sent_at = Carbon::now();
            $msg_db->is_received = 1;
            $msg_db->save();

            return redirect('/home');
        }

        if ($contact->authorized == 2) {

            $msg_db = new \App\Message;
            $msg_db->twilio_SID = 0;
            $msg_db->sender_id = \Auth::user()->id;
            $msg_db->sender_name = \Auth::user()->name;
            $msg_db->mobile = $number;
            $msg_db->link = $link;
            $msg_db->sent_at = Carbon::now();
            $msg_db->is_received = 2;
            $msg_db->save();

            return redirect('/home');
        }

        // $client = new Twilio\Rest\Client($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);

        // $client = new Twilio\Rest\Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));

        // $message = $client->messages->create(
        //     $number, // Text this number
        //     array(
        //         'from' => env('TWILIO_NUMBER'), // From a valid Twilio number
        //         'body' => "Link-Sling : " . $link . " | Sent By: " . \Auth::user()->name
        //     )
        // );

        // $msg_db = new \App\Message;
        // $msg_db->twilio_SID = $message->sid;
        // $msg_db->sender_id = \Auth::user()->id;
        // $msg_db->mobile = $number;
        // $msg_db->link = $link;
        // $msg_db->sent_at = Carbon::now();
        // $msg_db->save();

        // return redirect('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deliverSMS()
    {
        
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
        $message = \App\Message::find($id);
        $message->is_deleted = true;
        $message->save();
        return redirect('/history');
    }
}
