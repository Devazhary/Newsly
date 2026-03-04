<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\frontend\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(ContactRequest $request)
    {
        //validation
        $request->validated();

        // store
        $request->merge([
            'ip_address' => $request->ip(),
        ]);
        $contact = Contact::create($request->except('_token'));

        //check if data stored
        if (!$contact) {
            Session::flash('error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }

        Session::flash('success', 'Message Sent Successfully.');
        return redirect()->back();
    }
}
