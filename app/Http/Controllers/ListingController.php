<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listings
   public function index(){
    
    return view('listings.index',[
        'listings' => Listing::latest()->filter
        (request(['tag','search']))->simplepaginate(6)
    ]);
   }
   // show single listing
   public function show(Listing $listing){
    return view('listings.show', [
        'listing'=> $listing
    ]);

   }
//To show create form
   public function create(){
    return view('listings.create');
   }
//to store listing data
   public function store(Request $request){
       $formfields  = $request->validate([
        'title' => 'required',
        'company' => ['required', Rule::unique('listings',
        'company')],
        'location' => 'required',
        'website' => 'required',
        'tags' => 'required',
        'email' => ['required', 'email'],
        'description' => 'required'
       ]);

       if($request->hasFile('logo')){
        $formfields['logo'] = $request->file('logo')->store('logos', 'public');
       }
       $formfields['user_id'] = auth()->id();

       Listing::create($formfields);

       return redirect('/')->with('message', 'Listing Created Successfully');
   }

// show edit form
   public function edit(Listing $listing){
    return view('listings.edit', ['listing'=> $listing]);
   }

   // to update record or listing
   public function update(Request $request, Listing $listing){
    $formfields  = $request->validate([
        'title' => 'required',
        'company' => 'required',
        'location' => 'required',
        'website' => 'required',
        'tags' => 'required',
        'email' => ['required', 'email'],
        'description' => 'required'
       ]);

       if($request->hasFile('logo')){
        $formfields['logo'] = $request->file('logo')->store('logos', 'public');
       }

       $listing->update($formfields);

       return back()->with('message', 'Listing Updated Successfully');
   }
   public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
   }
}
