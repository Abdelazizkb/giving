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
        <div class="dropdown d-inline-block float-right pt-0 m-0">
           <button class="btn btn-default dropdown p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fa fa-angle-double-down"></i></button>  
        
           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

           <a class="btn btn-default text-primary" href="{{route('publication.edit',['publication'=>$publication])}}">Modifier</a>
            <button class="btn btn-default text-primary"  form="delete">Supprimer</button>

           </div>
      </div>
      @endif
      </div>
      <h2 class="article-title">{{ $publication->title }}</h2>
      <p class="article-content">{{ $publication->body }}</p>
      <img src="{{asset('storage/'.$publication->image->image)}}" alt="" class="col-md-8  d-inline">
      
      @if(! ($publication->publicatable->id == Auth::guard($type)->user()->id and ('app\\'.$type)==strtolower($publication->publicatable_type)))
        @if ($publication->type=="demande")
             @if (! Auth::guard('demandeur')->check())
             <div class="border-top col-md-12 d-block mt-1">
              <a  class=" btn btn-default border-secondary  m-1 float-right" href="{{route('help',['publication'=>$publication])}}">
                Aider ({{$publication->helps}})
              </a>
             </div>
              @endif
       @else
       <div class="border-top col-md-12 d-block mt-1">
        <a  class="btn btn-default border-secondary  m-1 float-right" href="{{route('take',['publication'=>$publication])}}">
          Benefecier ({{$publication->helps}})
        </a>
      </div>
        @endif
    
      @endif
     

    </div>
  </article>


@if($publication->responses->isEmpty())
    

  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Bienvenue {{Auth::guard($type)->user()->first_name}}!</strong> y'a aucune reponse encore
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif 
  <!-- boucle pour afficher les commentaire -->

 @foreach ($publication->responses as $response)
     
 
  <article class="media content-section">
    <img class="rounded-circle article-img" src="{{asset('storage/'.$response->responseable->image->image )}}">
    <div class="media-body">
      <div class="article-metadata">
      <a class="mr-2" href="{{route('profile-resposeable',['user'=> $response])}}">
        {{ $response->responseable->first_name  }}
      </a>
        <small class="text-muted">{{ $response->created_at }}</small>
      </div >
    <div id="modifier{{$response->id}}">
      <p id="responsebody{{$response->id}}" class="article-content">{{ $response->body }}</p>
      </div>
      @if($response->responseable->id == Auth::guard($type)->user()->id and ('app\\'.$type)==strtolower($response->responseable_type) ) 
      <button class="btn btn-default text-primary" id="btnmodifier{{$response->id}}" onclick="modifier({{$response}})">Modifier</button>
      <button class="btn btn-default text-primary" id="btnsupprimer{{$response->id}}" onclick="drop({{$response}})" >Supprimer</button>
     @endif
    </div>
  </article>
  
 

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
  
 
 <!-- formulaire pour modifier la reponse specifiee-->

  
  
 <form  method="post" id="update.comment" >
    @method('put')
    @csrf
   </form>



 <!-- formulaire pour supprimer la reponse specifiee-->


 <form  method="post" id="delete.comment" onsubmit="return confirm('Etse-vous sur ?')">
    @method('delete')
    @csrf
  </form>



  <!-- le script est pour modifier la vue lors que vous cliquer sur la btn modifier-->


<script >
function modifier(id){
   console.log(id.id);
  var container= document.getElementById("modifier"+id.id);
  var body=document.getElementById("responsebody"+id.id);
  console.log(body);
  var element=document.createElement('textarea');
  element.className="form-control border-0 "
  element.name="body";
  element.innerText=body.textContent;
  body.remove();
  element.setAttribute('form','update.comment');
  container.append(element);
  var btn =document.getElementById("btnmodifier"+id.id);
  btn.remove();
  var btn =document.getElementById("btnsupprimer"+id.id);
  btn.remove();
  var btn=document.createElement('button');
  btn.setAttribute("class","btn btn-default text-primary");
  btn.setAttribute("form","update.comment");
  btn.innerText='Modifier';
  var form=document.getElementById('update.comment');
  var route='/response/'+id.id;
  form.setAttribute('Action',route);
  console.log(form);
  container.append(btn);
}

function drop(id){
  var form=document.getElementById('delete.comment');
  var route='/response/'+id.id;
  form.setAttribute('Action',route);
  console.log(form);
  if (confirm('Etse-vous sur ?'))
  form.submit();

}


</script>










@endsection

