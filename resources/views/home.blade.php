@extends('layouts.base')

@section('content')


<a href="{{route('annonce.index')}}">voir tout >>></a>

<article class="media content-section bg-gris border-0 ">
  @if (Auth::guard('representant')->check())
<a class="btn btn-default text-dark  font-weight-bold bg-white rounded-pill w-50 mr-2 d-inline" href="{{route('annonce.create')}}">Cree votre annonce </a>
@endif

<a class="btn btn-default text-dark font-weight-bold bg-white rounded-pill w-50 mr-2 " href="{{route('publication.create')}}">Cree votre publication </a>
<button type="button" class="btn btn-default text-dark font-weight-bold bg-white rounded-pill w-50 mr-1 " onclick="filter()">Filtre</button>

</article>

<article class="media content-section " id="filter_box" hidden>
<select class="selectpicker form-control col-md-4 mr-2" name="category" id="category">
<option class="special">htht</option>

</select>

<select class="selectpicker form-control col-md-4" name="category" id="category">
  <option class="special">htht</option>
  
  </select>
  <button class="btn btn-default blue ml-4 text-white col-md-3" type="button">Filtre</button>

</article>

@foreach($publications->sortbydesc("updated_at") as $publication)

<article class="media content-section">
  <img class="rounded-circle article-img" src="{{asset('storage/'.$publication->publicatable->image->image )}}">
    <div class="media-body">
      <div class="article-metadata">
       
     <a class="mr-2" href="{{route('profile-visite',['user'=> $publication])}}">
          {{ $publication->publicatable->first_name  }}
     </a>
        <small class="text-muted">{{ $publication->created_at }}</small>
      </div>

      <h2><a class="article-title d-inline" href="{{route('publication.show',[$publication])}}">{{ $publication->title }}</a></h2>
    <img src="{{asset('storage/'.$publication->image->image)}}" alt="" class=" rounded d-block h-75 w-100">
  </div>

</article>



@endforeach


@endsection




@section('sidebar')
<div class="col-md-4">
  <div class="content-section">

  
    <h3>Domains</h3>
    <p class='text-muted'>Vous pouvez selectionner le domain que vous interesse.
     
        @foreach ($domains as $domain)
         <div class="mt-3 d-inline-block">
          <a class="text-capitalize text-dark bg-light    rounded text-decoration-none p-2   "  href="{{route('filter',['domain'=>$domain->name])}}">
          {{$domain->name}}
          </a> 
        </div>
        @endforeach


      </ul>
    </p>
  
  </div>
  © 2020 Copyright:
<a href="http://127.0.0.1:8000/"> GivingCom.com</a>
</div>

<script>
function filter(){
 if( document.getElementById('filter_box').hidden)
 {
  document.getElementById('filter_box').hidden=false;
 }
 else{
  document.getElementById('filter_box').hidden=true;
 }
}

</script>

@endsection




@section('slideshow')
<div id="carouselExampleIndicators" class="carousel slide mb-2 " data-ride="carousel">
  <ol class="carousel-indicators ">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>

  </ol>
  <div class="carousel-inner">
    @foreach ($annonces as $annonce)

    @if ($loop->first)
    <div class="carousel-item active ">
    @else
    <div class="carousel-item ">
    @endif
      <img class="d-block  w-100" height="350px" src="{{asset('storage/'.$annonce->image->image)}}" alt="Second slide">
    </div>
    @endforeach
  

  </div>
  <a class="carousel-control-prev  rounded-circle  orange" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon   p-2" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next rounded-circle orange" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon p-2" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

@endsection