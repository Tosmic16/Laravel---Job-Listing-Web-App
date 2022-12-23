<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\RedirectMiddleware;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // To show register form
    public function create(){
       return view('users.register');
    }

    //To Create new user
    public function  store(Request $request){
        $formfields  = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
           ]);

            //hash password
           $formfields['password'] = bcrypt($formfields['password']);
                      
           //store user
          $user = User::create($formfields);
           
           //login
           auth()->login($user);

           return redirect('/')->with('message', 'User Created  and Logged In Successfully');
    
    }

//log user out
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/')->with('You have been logged out successfully');
     }

    //To show login page
    public function login(){
        return view('users.login');
     }

     //To authenticate user
     public function authenticate(Request $request){
        $formfields  = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
           ]);

            if(auth()->attempt($formfields)){
                $request->session()->regenerate();
                return redirect('/')->with('you are logged in');
            }


           return back()->withErrors(['email'=> 'invalid credentials'])->onlyInput('email');
    
     }
}
