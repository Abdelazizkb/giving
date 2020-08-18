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



  <!-- boucle pour afficher les commentaire -->

 @foreach ($publication->responses as $response)
     
 
  <article class="media content-section">
    <img class="rounded-circle article-img" src="{{asset('storage/'.$response->responseable->image->image )}}">
    <div class="media-body">
      <div class="article-metadata">
      <a class="mr-2" href="{{route('profile-visite',['user'=> $publication])}}">
        {{ $response->responseable->first_name  }}
      </a>
        <small class="text-muted">{{ $response->created_at }}</small>
      </div >
    <div id="modifier{{$response->id}}">
      <p id="responsebody{{$response->id}}" class="article-content">{{ $response->body }}</p>
      </div>
      @if($response->responseable->id == Auth::guard($type)->user()->id and ('app\\'.$type)==strtolower($response->responseable_type) ) 
      <button class="btn btn-default text-primary" id="btnmodifier{{$response->id}}" onclick="modifier({{$response->id}})">Modifier</button>
      <button class="btn btn-default text-primary" id="btnsupprimer{{$response->id}}" form="delete.comment">Supprimer</button>
     @endif
    </div>
  </article>
  
  <!-- formulaire pour modifier la reponse specifiee-->
  <form action="{{route('response.update',['response'=>$response])}}" method="post" id="update.comment" >
    @method('put')
    @csrf
   </form>


     <!-- formulaire pour supprimer la reponse specifiee-->

  <form action="{{route('response.destroy',['response'=>$response])}}" method="post" id="delete.comment" onsubmit="return confirm('Etse-vous sur ?')">
    @method('delete')
    @csrf
   </form>

  @endforeach


  <article class="media content-section">
     <form action="{{route('response.store')}}" method="post">
         @csrf

         <input type="number" hidden id="id" name="id" value="{{$publication->id}}">
         <textarea class="form-control"  placeholder="Publier un commentaire" id="body" name="body" cols="200" rows="5"></textarea>
         <button  class="btn btn-outline-primary m-1" type="submit">commenter</button>
      </form>    
  </article>

  <!-- formulaire pour supprimer la publication specifiee-->

<form action="{{route('publication.destroy',['publication'=>$publication])}}" method="post" id="delete" onsubmit="return confirm('Etse-vous sur ?')">
  @method('delete')
  @csrf
 </form>

  <!-- le script est pour modifier la vue lors que vous cliquer sur la btn modifier-->


<script >
function modifier(id){
   
  var container= document.getElementById("modifier"+id);
  var body=document.getElementById("responsebody"+id);
  console.log(body);
  var element=document.createElement('textarea');
  element.className="form-control border-0 "
  element.name="body";
  element.innerText=body.textContent;
  body.remove();
  element.setAttribute('form','update.comment');
  container.append(element);
  var btn =document.getElementById("btnmodifier"+id);
  btn.remove();
  var btn =document.getElementById("btnsupprimer"+id);
  btn.remove();
  var btn=document.createElement('button');
  btn.setAttribute("class","btn btn-default text-primary");
  btn.setAttribute("form","update.comment");

  btn.innerText='Modifier';
  container.append(btn);
}




</script>










@endsection

