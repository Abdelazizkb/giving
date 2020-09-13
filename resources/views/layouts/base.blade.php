
<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" >
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" 
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="/path/to/flickity.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css') }}">

    <title>{{ $title ?? 'home'}}</title>
    @livewireStyles

</head>
<body>
    <header class="site-header">
      <nav class="navbar navbar-expand-md navbar-dark bg-steel fixed-top ">
        <div class="container">
        <a class="navbar-brand mr-4 " href="{{ url('/') }}" ><img width="60" src="{{asset('img/logo.png')}}" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon "></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarToggle">
            <div class="navbar-nav mr-auto">
              <a class="nav-item nav-link" href="{{ url('/') }}"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a>  
            </div>
            <!-- Navbar Right Side -->
            <div class="navbar-nav">
               @auth()
            <a class="nav-item nav-link" href="{{route('profile') }}"><img class="rounded-circle " width="40px" src="{{asset('storage/'.Auth::user()->image->image)}}" alt=""></a>
                <a class="nav-item nav-link" href="{{route('Logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" ><i class="fa fa-sign-out fa-2x"></i></a>
                <form id="logout-form" action="{{ route('Logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
              @endauth()
              @guest()
                <a class="nav-item nav-link" href="{{route('login') }}">Connexion</a>
                <a class="nav-item nav-link" href="{{route('register') }}">S'inscrir</a>
              @endguest
            </div>
          </div>
        </div>
      </nav>
    </header>
 <!-- <img  width="70%" height="500px" class="image-header"  margin="0 auto"  alt="kljlk">
 -->
    <main role="main" >
      <div class="container">
        @yield('slideshow')

      </div>
     
      <div class="container">
        <div class=" row">
           <div class="col-md-8">
          
          @yield('content')
          </div>

           @yield('sidebar')
        </div>
      </div>  
    </main>
    <script src="//code.jquery.com/jquery.js"></script>

    @include('flashy::message')
    @livewireScripts

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/path/to/flickity.pkgd.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>