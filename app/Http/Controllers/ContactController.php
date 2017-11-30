<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

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
        // $test = [['name' => 'Amanda'], ['name' => 'Mom'], ['name' => 'Jonathan']];

        return response()->json($test);
        // return response($test);
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
        $name = Input::get('name');
        $mobile = Input::get('mobile');

        $contact_db = new \App\Contact;
        $contact_db->owner = \Auth::user()->id;
        $contact_db->name = $name;
        $contact_db->mobile = $mobile;
        $contact_db->save();

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
        //
    }
}
