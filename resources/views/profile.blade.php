@extends('layouts.base',['title'=>'profile'])

@section('content')

    <div class="content-section">
      <div class="media">
        <img class="rounded-circle account-img" src="{{asset('storage/'.Auth::user()->image->image)}}">
        <div class="media-body">
          <h2 class="account-heading">{{ Auth::user()->first_name }}</h2>
          <p class="text-secondary">{{ Auth::user()->last_name }}</p>
        </div>
      </div>
   
    </div>
@endsection
