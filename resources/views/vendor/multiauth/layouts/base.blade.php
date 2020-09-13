<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>{{$title ?? 'home'}}</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    @livewireStyles

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header border-bottom">
            <h3 >GivingAdmin</h3>
            </div>

            <ul class="list-unstyled components">
            <p><a href="/admin/home"><i class="fa fa-user"></i> {{auth('admin')->user()->name}}</a></p>
          
              <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Admins</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        @admin('super')
                        <li>
                            <a href="{{ route('admin.show') }}">{{
                                ucfirst(config('multiauth.prefix')) }}</a>
                        </li>
                        @permitToParent('Role')

                        <li>
                            <a  href="{{ route('admin.roles') }}">Roles</a>
                        </li>
                        @endpermitToParent
                        @endadmin
                    </ul>
                </li>
              
             
                <li>
                <a href="{{route('donors-list')}}">Donateurs</a>
                </li>
                <li>
                    <a href="{{route('demandeurs-list')}}">Demandeurs</a>
                </li>
                <li>
                    <a href="{{route('membres-list')}}">Membres</a>
                </li>
                <li>
                    <a href="{{route('publications-list')}}">Publications</a>
                </li>
                <li>
                    <a href="{{route('annonces-list')}}">Annonces</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="/admin/logout" class="download" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                     {{ __('Déconnecter') }}</a>                </li>
                     <li>
                        <a href="{{ route('admin.password.change')}}" class="article">Parametere</a>
                    </li>
               
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <div class="col-md-8 mx-auto">
            @yield('content')
            </div>
        </div>
        @livewireScripts
       
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>