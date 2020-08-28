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
      <div class="form-inline">
          <input class="form-control   border-0 col-md-8 mr-0 pr-2 " form="update" value="{{ $annonce->title }}" name="title"> 
           <i class="fa fa-edit d-inline ml-0 fa-2x"></i>
           {!! $errors->first('title','
           <div class="text-danger p2" role="alert">
               <strong> :message </strong>
           </div>')!!}
      </div>

      <textarea class="form-control d-block mb-2 mt-3 border-0 " form="update" name="body" autofocus >{{ $annonce->body }} </textarea>
      {!! $errors->first('body','
            <div class="text-danger p2" role="alert">
                <strong> :message </strong>
            </div>')!!}
      <label for="image" ><img src="{{asset('storage/'.$annonce->image->image)}}" alt="" class="col-md-8  d-inline"> </label>  
    </div>
    <input type="file" hidden id="image" name="image" form="update">
    
    <button type="submit" class="btn btn-default font-bleu" form="update">Confirmer</button>
  </article>
<form action="{{route('annonce.update',['annonce'=>$annonce])}}" enctype="multipart/form-data" method="post" id="update">
@method('put')
@csrf
</form>
   
@endsection
