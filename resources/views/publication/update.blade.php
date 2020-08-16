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
      </div>
      <div class="form-inline">
          <input class="form-control   border-0 col-md-8 mr-0 pr-2 " form="update" value="{{ $publication->title }}" name="title"> 
           <i class="fa fa-edit d-inline ml-0 fa-2x"></i>
           {!! $errors->first('title','
           <div class="text-danger p2" role="alert">
               <strong> :message </strong>
           </div>')!!}
      </div>
      <textarea class="form-control d-block mb-2 mt-3 border-0 " form="update" name="body" autofocus >{{ $publication->body }} </textarea>
      {!! $errors->first('body','
            <div class="text-danger p2" role="alert">
                <strong> :message </strong>
            </div>')!!}
      <label for="image" ><img src="{{asset('storage/'.$publication->image->image)}}" alt="" class="col-md-8  d-inline"> </label>  
    </div>
    <input type="file" hidden id="image" name="image" form="update">
    
    <button type="submit" class="btn btn-default font-bleu" form="update">Confirmer</button>
  </article>
<form action="{{route('publication.update',['publication'=>$publication])}}" enctype="multipart/form-data" method="post" id="update">
@method('put')
@csrf
</form>
   
@endsection
