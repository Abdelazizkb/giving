@extends('layouts.base',['title'=>'home'])

@section('content')

<article class=" post-section">
  <div class="d-block w-100 p-2">
       @include('partials._annonceheader')

  
       @include('partials._annoncedropdown')

      <h2>{{ $annonce->title }}</h2>

      <p class="article-content">{{ $annonce->body }}</p>
      <strong class="article-content">Le : {{  \Carbon\Carbon::parse($annonce->from_date)->format('d/m/Y') }}</strong>

    </div>
      <img class=" mb-3 d-block h-75 w-100 " src="{{asset('storage/'.$annonce->image->image)}}" alt="" >
  
</article>




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

