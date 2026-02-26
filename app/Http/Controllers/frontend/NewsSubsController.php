<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\NewsSubs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\Frontend\NewsSubsMail;

class NewsSubsController extends Controller
{
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'email' => ['required', 'email', 'unique:news_subs,email'],
        ]);

        //create news subscription
        try{

            NewsSubs::create([
                'email' => $request->email,
            ]);

            Session::flash('success', 'You have successfully subscribed to our news updates.');
            Mail::to($request->email)->send(new NewsSubsMail());
            return redirect()->back();

        }catch(\Exception $e){
            Session::flash('error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }

    }
}
