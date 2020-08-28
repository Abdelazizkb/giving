@extends('layouts.base')
@section('content')
@foreach($annonces->sortbydesc("updated_at") as $annonce)

<article class="media content-section">
 <img class="rounded-circle article-img" src="{{asset('storage/'.$annonce->association->image->image )}}"> 
    <div class="media-body">
      <div class="article-metadata">
       
      <a class="mr-2" href="{{route('association.show',['association'=>$annonce->association])}}">
          {{ $annonce->association->name  }}
     </a>
        <small class="text-muted">{{ $annonce->created_at }}</small>
      </div>

      <h2><a class="article-title d-inline" href="{{route('annonce.show',[$annonce])}}">{{ $annonce->title }}</a></h2>
    <img class=" rounded d-block h-75 w-100 " src="{{asset('storage/'.$annonce->image->image)}}" alt="" >
  </div>
  @if(Auth::guard('representant')->check() )
         @if (Auth::guard('representant')->user()->association_id == $annonce->association->id)
         <div class="dropdown">
            <button class="btn btn-default dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-angle-double-down"></i></button>  
          
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

          <a class="btn btn-default text-primary" href="{{route('annonce.edit',['annonce'=>$annonce])}}">Modifier</a>
          <button class="btn btn-default text-primary" type="button"  onclick='drop({{$annonce->id}})'  >Supprimer</button>

          </div>
        </div>
          @endif
  @endif
</article>



@endforeach
<form id="delet" method="post">
  {{ csrf_field() }}
  @method('delete')
  </form>


 <script>
function drop(annonce){
  var form=document.getElementById('delet');
  var route='annonce/'+annonce;
  console.log(route);
  form.action=route;
form.submit()
}   
   
</script> 
@endsection