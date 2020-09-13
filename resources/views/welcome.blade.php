<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css') }}">
    <title>GivingCom</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white ml-2 mr-2 fixed-top mt-2 rounded">
        <div class="container-fluid">


            <img width="60" src="{{asset('img/logo.png')}}" alt="">

            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">



                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    </li>

                    @else
                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">S'inscrir</a>
                    </li>
                    @endif
                    @endauth

                    @endif

                </ul>
            </div>
        </div>
    </nav>
    <div class="bg-white ml-2 mr-2 rounded welcom-header" height="300px">
        <img class="w-50 h-100 mx-auto d-inline-block rounded-left" src="{{asset('img/donate1.jpg')}}" alt="">
        <div class="d-inline-block">
            <h1 class="text-monospace"> Bienvenue sur GivingCom</h1>
            <strong  >
             <pre class="text-muted">   Pour aider des gens ou pour partager
                 votre besoin s'inscrir sur givingcom 
            </pre>      
               </strong>
             

            <a class="btn btn-outline-primary d-block rounded-pill col-md-6 mx-auto mt-3"
                href="{{ route('register') }}">S'inscrir</a>
        </div>
    </div>


    <div class="col-md-6 mx-auto">
        @livewire('publications-list')
    </div>
    @livewireScripts

    <script>
        document.getElementById('filter_box').hidden = true;
    </script>
</body>

</html>