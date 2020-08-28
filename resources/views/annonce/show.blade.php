@extends('layouts.base',['title'=>'home'])

@section('content')

  <article class="media content-section">
    <img class="rounded-circle article-img" src="{{asset('storage/'.$annonce->association->image->image )}}">
    <div class="media-body">
      <div class="article-metadata">
      <a class="mr-2" href="{{route('association.show',['association'=> $annonce->association])}}">
        {{ $annonce->association->name  }}
      </a>
        <small class="text-muted">{{ $annonce->created_at }}</small>
        
       
      </div>
      <h2 class="article-title">{{ $annonce->title }}</h2>
      <p class="article-content">{{ $annonce->body }}</p>
      <p class="article-content">{{ $annonce->date }}</p>
      <img src="{{asset('storage/'.$annonce->image->image)}}" alt="" class="col-md-8  d-inline">
    </div>
  </article>








@endsection

