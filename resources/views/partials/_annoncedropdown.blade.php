<div class="dropdown float-right">
    <button class="btn btn-default dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-ellipsis-h fa-2x"></i></button>  
  
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   @if(Auth::guard('representant')->check() )
      @if (Auth::guard('representant')->user()->association_id == $annonce->association->id)
         <a class="btn btn-default text-primary dropdown-item" href="{{route('annonce.edit',['annonce'=>$annonce])}}">Modifier</a>
         <button class="btn btn-default text-primary dropdown-item" type="button"  onclick='drop({{$annonce->id}})'  >Supprimer</button>
     @endif  
  @endif
  @if(Auth::guard('representant')->check() )
   @if (! Auth::guard('representant')->user()->association_id == $annonce->association->id)
  <a  class="btn btn-default text-primary " href="/participate/{{$annonce->id}}">
   Participer({{$annonce->participers}})
  </a> 
    @endif
   @else
   <a  class="btn btn-default text-primary " href="/participate/{{$annonce->id}}">
    Participer({{$annonce->participers}})
   </a>  
  @endif
  </div>
</div>