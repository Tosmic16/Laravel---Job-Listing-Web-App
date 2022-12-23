<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InvokerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private $tosin;
    public function __construct()
    {
        if(1!="1"){
        $this->middleware(function ($request, $next) {
            return redirect('/');
        });
    }
    }

    public function __invoke(Request $request)
    {
        $this->tosin = "1";
        if(gettype($this->tosin) =="string"){
            echo "powpa";
        $this->middleware(function ($request, $next) {
            return redirect('/');
        });
    }
        dd($this->tosin);
    }
}
