@extends('layouts.base')
@section('content')
@foreach($annonces->sortbydesc("updated_at") as $annonce)

<article class=" post-section">
  <div class="d-block w-100 p-2">
    
    @include('partials._annonceheader')

    @include('partials._annoncedropdown')


      <h2><a class="article-title d-inline" href="{{route('annonce.show',[$annonce])}}">{{ $annonce->title }}</a></h2>
    </div>
      <img class=" rounded-bottom d-block h-75 w-100 " src="{{asset('storage/'.$annonce->image->image)}}" alt="" >
  
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