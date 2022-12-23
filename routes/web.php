<?php

use App\Models\User;
use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvokerController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//For all job listings
Route::get('/invoker', InvokerController::class);
Route::get('/', [ListingController::class, 'index']);

Route::get('/test', function(Request $request){
     $request->session()->regenerate();
    return csrf_token();
});
//show create form
Route::get('/listings/create',  [ListingController::class, 'create'])->middleware('auth');

//to store listing data
Route::post('/listings',  [ListingController::class, 'store'])->middleware('auth');

// for single job listing
Route::get('/listings/{listing}',  [ListingController::class, 'show'])->missing(function (Request $request){
    return redirect('/');
});

Route::get('/listings/{listing}/edit/',  [ListingController::class, 'edit'])->middleware('auth');

Route::put('/listings/{listing}',  [ListingController::class, 'update'])->middleware('auth');

Route::delete('/listings/{listing}',  [ListingController::class, 'destroy'])->middleware('auth');

//show register form
Route::get('/register',  [UserController::class, 'create'])->middleware('guest');

//show login page
Route::get('/login',  [UserController::class, 'login'])->name('login')->middleware('guest');

//create new user
Route::post('/users', [UserController::class, 'store'])->middleware('guest');


Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/post',  function(){
    return response()->json([
        'post' => 'health'
       ]);
}
    
);

Route::resource('git',GitController::class);
Route::get('/event', [NewsletterController::class, 'index']);
Route::post('/subscribe', [NewsletterController::class, 'subscribe']);
Route::post('/test', [NewsletterController::class, 'test']);

