@extends('layouts.base',['title'=>'home'])

@section('content')

  <article class="media content-section">
    <img class="rounded-circle article-img" src="{{asset('storage/'.$publication->publicatable->image->image )}}">
    <div class="media-body">
      <div class="article-metadata">
      <a class="mr-2" href="{{route('profile-visite',['user'=> $publication])}}">
        {{ $publication->publicatable->first_name  }}
      </a>
        <small class="text-muted">{{ $publication->created_at }}</small>
        
        @if($publication->publicatable->id == Auth::guard($type)->user()->id and ('app\\'.$type)==strtolower($publication->publicatable_type) ) 
        <div>
            <a class="btn btn-secondary btn-sm mt-1 mb-1" href="{{route('publication.edit',['publication'=>$publication])}}" >Update</a>
            <button class="btn btn-danger btn-sm mt-1 mb-1" form="delete">Delete</button>
          </div>
        @endif
      </div>
      <h2 class="article-title">{{ $publication->title }}</h2>
      <p class="article-content">{{ $publication->body }}</p>
      <img src="{{asset('storage/'.$publication->image->image)}}" alt="" class="col-md-8  d-inline">
    </div>
  </article>
 
<form action="{{route('publication.destroy',['publication'=>$publication])}}" method="post" id="delete" onsubmit="return confirm('Etse-vous sur ?')">
  @method('delete')
  @csrf
 </form>
@endsection
