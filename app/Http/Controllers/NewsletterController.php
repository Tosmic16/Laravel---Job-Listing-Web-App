<?php

namespace App\Http\Controllers;

use App\Events\UserSubscribed;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(){
        return view('event');
    }

    public function subscribe(Request $request){
        $request->validate([
            'email' => 'required'
        ]);
        event(new UserSubscribed(
            $request->input('email')
        ));
        return back();
    }
    public function test(Request $request){
        $use =   $request->cookie('name');
        var_export($use);

       
    }
}
