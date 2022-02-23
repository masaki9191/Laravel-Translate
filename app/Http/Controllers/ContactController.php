<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactEmail;
use Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contact::create($request->all());
        $this->sendMail($request->all());
        return redirect()->route('contact.complete');
    }

    public function sendMail($data){
        $details = [
            'title' => 'お問い合わせをお願いします。',
            'email' => $data['email'],
            'name' => $data['name'],
            'body' => $data['content']
        ];
        Mail::to("info@eztrans49.com")->send(new ContactEmail($details) );
    }

}
