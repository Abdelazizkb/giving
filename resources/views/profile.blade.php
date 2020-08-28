@extends('layouts.base',['title'=>'profile'])

@section('content')

    <div class="content-section">
      <div class="media">
        <img class="rounded-circle account-img" src="{{asset('storage/'.$user->image->image)}}">
        <div class="media-body">
          <h2 class="account-heading">{{ $user->first_name }}</h2>
          <p class="text-secondary">{{ $user->last_name }}</p>
          <p class="text-secondary">{{ $user->email }}</p>
          @if($user->association)
          <p class="text-secondary">Membre de l'association 
            <a class="text-decoration-none" href="{{route('association.show',['association'=>$user->association])}}">
             {{ $user->association->name }}</a>
          </p>
          @endif
        </div>
      </div>
    </div>
   
 
    <article class="media content-section">
     <button class="btn btn-default text-primary border-right w-50"  type="submit">Publications</button>
     <button class="btn btn-default text-primary w-50 " type="submit">Reponses</button>
  </article>
    @foreach($user->publications->sortbydesc("updated_at") as $publication)
 
<article class="media content-section">
    <div class="media-body">
      <div class="article-metadata">
        <a class="mr-2" href="{{route('profile')}}">{{ $publication->publicatable->first_name  }} </a>
        <small class="text-muted">{{ $publication->created_at }}</small>
      </div>
      <h2><a class="article-title" href="{{route('publication.show',[$publication])}}">{{ $publication->title }}</a></h2>   
    <img src="{{asset('storage/'.$publication->image->image)}}" alt="" class="col-md-8  d-inline">
  </div>
</article>


  @endforeach
@endsection
