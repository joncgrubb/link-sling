<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
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
     * Display a list of saved contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function contacts()
    {
        $contacts = \Auth::user()->contacts()->orderBy('name', 'asc')->get();

        return view('contacts.contacts', compact('contacts'));
    }

    /**
     * Update the selected Contact in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function editContact(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
        ]);

        $name = Input::get('name');
        $mobile = Input::get('mobile');

        $contact_db = \Auth::user()->contacts()->where('id', $id)->first();
        $contact_db->owner = \Auth::user()->id;
        $contact_db->name = $name;
        $contact_db->mobile = $mobile;
        $contact_db->save();

        return redirect('/contacts');
    }

    /**
     * Get matching contacts for Axios.
     *
     * @return \Illuminate\Http\Response
     */
    public function axiosGetContacts(Request $request)
    {
        $query = Input::get('query');
        $users = \Auth::user()->contacts()->where('name','like','%'. $query .'%')->pluck('name');
        $contacts = [];
        for ($i = 0; $i < sizeof($users); $i++) {
            array_push($contacts, 
                ['name' => $users[$i]]
            );
        }
        $test = $contacts;

        return response()->json($test);
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
     * Store a newly created Contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
        ]);

        $name = Input::get('name');
        $mobile = Input::get('mobile');
        $name_test = false;
        $mobile_test = false;

        // return \App\Contact::where('name', $name)->where('owner', \Auth::user()->id)->first();
        
        // Set name_test variable after checking if exists in DB
        if (\App\Contact::where('name', $name)->where('owner', \Auth::user()->id)->count() > 0) {
            $name_test = true;
        }

        // Set mobile_test variable after checking if exists in DB 
        if (\App\Contact::where('mobile', $mobile)->where('owner', \Auth::user()->id)->count() > 0) {
            $mobile_test = true;
        }

        // If a contact exists and was soft deleted, undelete it
        if ($name_test && $mobile_test) {
            $contact = \App\Contact::where('name', $name)->where('owner', \Auth::user()->id)->first();
            $contact->name = $name;
            $contact->is_deleted = false;
            $contact->save();
        }

        // Create the new contact
        else {
            $get_all_mobiles = \App\Contact::where('mobile', $mobile)->get();
            $mobile_auth = false;
            foreach ($get_all_mobiles as $single_mobile) {
                if ($single_mobile->mobile == $mobile) {
                    $mobile_auth = true;
                    $repeat_auth = $single_mobile->authorized;
                    break;
                }
            }

            if($mobile_auth == false) {
                $contact_db = new \App\Contact;
                $contact_db->owner = \Auth::user()->id;
                $contact_db->name = $name;
                $contact_db->mobile = $mobile;
                $contact_db->save();
            }
            else {
                $contact_db = new \App\Contact;
                $contact_db->owner = \Auth::user()->id;
                $contact_db->name = $name;
                $contact_db->mobile = $mobile;
                $contact_db->authorized = $repeat_auth;
                $contact_db->save();
            }
        }

        return redirect('/contacts');
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
     * Update the selected Contact in storage.
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
        $contact = \App\Contact::find($id);
        $contact->is_deleted = true;
        $contact->save();
        
        return redirect('/contacts');
    }
}
