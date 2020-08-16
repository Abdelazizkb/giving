@extends('layouts.base')

@section('content')

<article class="media content-section">
<a class="btn font-orange border-orange  " href="{{route('publication.create')}}">Cree votre publication </a>

</article>


@foreach($publications as $publication)

<article class="media content-section">
  <img class="rounded-circle article-img" src="{{asset('storage/'.$publication->publicatable->image->image )}}">
    <div class="media-body">
      <div class="article-metadata">
       
     <a class="mr-2" href="{{route('profile-visite',['user'=> $publication])}}">
          {{ $publication->publicatable->first_name  }}
     </a>
        <small class="text-muted">{{ $publication->created_at }}</small>
      </div>
      <h2><a class="article-title" href="{{route('publication.show',[$publication])}}">{{ $publication->title }}</a></h2>
      <p class="article-content">content</p>
    </div>
    <img src="{{asset('storage/'.$publication->image->image)}}" alt="" class="col-md-8  d-inline">
</article>


  @endforeach


@endsection
