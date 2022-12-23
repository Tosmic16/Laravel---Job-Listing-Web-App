{{-- @php

// $valid_passwords = array ("mario" => "carbonell");
// $valid_users = array_keys($valid_passwords);

// $user = $_SERVER['PHP_AUTH_USER'];
// $pass = $_SERVER['PHP_AUTH_PW'];

// $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

// if (!$validated) {
//   header('WWW-Authenticate: Basic realm="My Realm"');
//   header('HTTP/1.0 401 Unauthorized');
//   die ("Not authorized");
// }

// If arrives here, is a valid user.
// echo "<p>Welcome $user.</p>";
echo "<p>Congratulation, you are into the system.</p>";

@endphp

@extends('layout')

@section('content')
{{$id}}.
<h3>  {{$list['title']}}</h3>
{{$list['description']}}
@endsection --}}


<x-layout>
@include('partials._hero')
@include('partials._search')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4" >

@unless (count($listings) == 0)

                    
  
    {{-- <h1> {{$heading}}</h1> --}}
    @foreach ($listings as $listing)
    <x-listing-card :listing="$listing" />

        @endforeach
@else
        <h5> No Listing found </h5>
@endunless

</div>

 <div class="mt-6 p-4">
 {{$listings->links()}}       
</div>  
</x-layout>