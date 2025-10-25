<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/icono.png">

    <title>PriscoSpanish</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="css/jquery.Jcrop.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/cpanel.css">
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        
        .popover{
            width:300px;
        }
    </style>
     @stack('csss')
</head>
<body>
    
    <nav class="navbar  navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="max-width:100px" src="img/logo.png" alt="">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a class="dashboard-ico" href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a class="store-ico" href="#">Store</a></li>
                    
                    
                    <li class="dropdown">
                      <a href="#" class="sessions-ico dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sessions <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="groupl-ico" href="#">Group</a></li>
                        <li><a class="privatel-ico" href="{{ url('/private-sessions') }}">Private</a></li>
                        
                      </ul>
                    </li>
                    
                    <li><a class="recursos-ico" href="{{ url('/resources') }}">Resources</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Language <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="" href="#">English</a></li>
                        <li><a class="" href="#">French</a></li>
                        <li><a class="" href="#">Spanish</a></li>
                      </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#"  id="messages" class="mensaje-ico dropdown-toggle" data-toggle="popover" role="button" data-placement="bottom" aria-haspopup="true" aria-expanded="false" data-trigger="focus" title="Inbox" data-content="There are not pending messages"> <span class="caret"></span></a>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#"  id="messages" class="notificacion-ico dropdown-toggle" data-toggle="popover" role="button" data-placement="bottom" aria-haspopup="true" aria-expanded="false" data-trigger="focus" title="Notifications" data-content="You have not pending Notifications"> <span class="caret"></span></a>
                    </li>

                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle cuenta-ico" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a class="perfil-ico" href="{{ url('/profile') }}">Profile</a></li>
                                <li><a class="ajustes-ico" href="{{ url('/settings') }}">Account Settings</a></li>
                                <li><a class="cerrar-ico" href="{{ url('/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div style="height:100px;">&nbsp;</div>
    
    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="js/ps_dashboard.js"></script>
     @stack('scripts')
</body>
</html>
