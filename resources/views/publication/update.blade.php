@extends('layouts.base',['title'=>'home'])
@section('content')
<article class="post-section">
  <div class="block w-100  p-2 ">
    <div class="block w-100">
     <img class="rounded-circle account-icon" src="{{asset('storage/'.$publication->publicatable->image->image )}}">
          <div class="d-inline-block">
             <a class="mr-2 d-block" href="{{route('profile-visite',['user'=> $publication])}}">
              {{ $publication->publicatable->first_name  }}
              </a>
             <small class="text-muted">{{ \Carbon\Carbon::parse($publication->created_at)->format('d/m/Y')  }}</small> 
          </div>
          <button type="submit" class="btn btn-default font-bleu d-inline-block float-right" form="update">Confirmer</button>

       </div>

      <div class="form-inline">
          <input class="form-control   border-0 col-md-8 mr-0 pr-2 " form="update" value="{{ $publication->title }}" name="title"> 
           <i class="fa fa-edit d-inline ml-0 fa-2x"></i>
           {!! $errors->first('title','
           <div class="text-danger p2" role="alert">
               <strong> :message </strong>
           </div>')!!}
      </div>
      <textarea class="form-control d-block mb-2 mt-3 border-0  visible" form="update" name="body"  autofocus >{{ $publication->body }} </textarea>
      {!! $errors->first('body','
            <div class="text-danger p2" role="alert">
                <strong> :message </strong>
            </div>')!!}
    </div>
       <label for="image" class="w-100 h-75" > 
          <div class="container p-0 m-0 w-100 h-75 position-relative"> 
          <img src="{{asset('storage/'.$publication->image->image)}}" alt="" class="w-100 h-75  d-block">
           <i class="fa fa-edit d-inline ml-0 fa-2x position-absolute fixed-top float-right text-right"></i> 
          </div>
        </label>  
   
    <input type="file" hidden id="image" name="image" form="update">
    
  </article>
<form action="{{route('publication.update',['publication'=>$publication])}}" enctype="multipart/form-data" method="post" id="update">
@method('put')
@csrf
</form>
   
@endsection
