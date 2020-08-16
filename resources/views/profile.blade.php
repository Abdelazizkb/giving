@extends('layouts.base',['title'=>'profile'])

@section('content')

    <div class="content-section">
      <div class="media">
        <img class="rounded-circle account-img" src="{{asset('storage/'.$user->image->image)}}">
        <div class="media-body">
          <h2 class="account-heading">{{ $user->first_name }}</h2>
          <p class="text-secondary">{{ $user->last_name }}</p>
        </div>
      </div>
   
    </div>
   
    @foreach($user->publications as $publication)
 
<article class="media content-section">
    <div class="media-body">
      <div class="article-metadata">
        <a class="mr-2" href="{{route('profile')}}">{{ $publication->publicatable->first_name  }} </a>
        <small class="text-muted">{{ $publication->created_at }}</small>
      </div>
      <h2><a class="article-title" href="{{route('publication.show',[$publication])}}">{{ $publication->title }}</a></h2>
      <p class="article-content">content</p>
    </div>
    <img src="{{asset('storage/'.$publication->image->image)}}" alt="" class="col-md-8  d-inline">
  </article>


  @endforeach
@endsection
