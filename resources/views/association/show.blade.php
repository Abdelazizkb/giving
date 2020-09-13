@extends('layouts.base',['title'=>'association'])

@section('content')

    <div class="content-section">
      <div class="media">
        <div class="dropdown">
          <button class="btn btn-default dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         
          @if(! $association->image==null)
              <img class="rounded-circle account-img" src="{{asset('storage/'.$association->image->image)}}">
          @else
              <img class="rounded-circle account-img" alt="image">
          @endif
          
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
               @if(Auth::guard('representant')->check() )
                   @if (Auth::guard('representant')->user()->association_id == $association->id)
                      <button class="btn btn-default" type="submit"  id="input.img">Modifier</button>
                   @endif
              @endif
          </div>
        
        </div>
   
       

        <div class="media-body">
        
          <h2 class="account-heading">{{ $association->name }} </h2>
          <p class="text-secondary">{{ $association->domain }} </p>
          <p class="text-secondary">{{ $association->email }}  </p>
          <p class="text-secondary">{{ $association->phone }}  </p>
        </div>
      </div> 
      
    </div>

    @foreach($association->annonces->sortbydesc("updated_at") as $annonce)

    <article class="media content-section">
      @if(! $association->image==null)
              <img class="rounded-circle account-img" src="{{asset('storage/'.$association->image->image)}}">
         @else
              <img class="rounded-circle account-img" alt="image">
      @endif 
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
                     <button class="btn btn-default text-primary" type="submit" form="delete" id="input.img">Supprimer</button>
    
              </div>
            </div>
              @endif
      @endif
    </article>
    
    <form action="{{route('annonce.destroy',['annonce'=>$annonce])}}" id="delete" method="post">
    {{ csrf_field() }}
    @method('delete')
    </form>
    
    @endforeach

<form action="{{route('association.update',['association'=>$association])}}" enctype="multipart/form-data" id="update.association" method="post">
  @csrf
 @method('put')
 <input type="file" name="image" id="image" onchange="submit()" hidden>
</form>
<script>
    var form=document.getElementById('update.association')
    var img=document.getElementById("image");
    var btn_img=document.getElementById("input.img");

    btn_img.onclick = function(){
    img.click();
    }

</script>
@endsection
