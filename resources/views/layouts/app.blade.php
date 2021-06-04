<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TopWines</title>
    <link rel="icon" type="imagen/PNG" href="{{asset('img/new_logo.png')}}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/437dc1cf45.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="{{asset('js/functions.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<header>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow p-3 mb-5" id="barraCabecera">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img id="logoCabecera" src="{{asset('img/new_logo.png')}}">
                </a>
                <div class="navbar navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <a id="navbar-link" class="nav-link" href="{{ url('/') }}">Inicio</a>
                        <a id="navbar-link" class="nav-link" href="{{route('wine.tintos')}}">Tintos</a>
                        <a id="navbar-link" class="nav-link" href="{{route('wine.rosados')}}">Rosados</a>
                        <a id="navbar-link" class="nav-link" href="{{route('wine.blancos')}}">Blancos</a>
                        <a id="navbar-link" class="nav-link" href="{{route('topSumiller')}}">Top Sumiller</a>
                        <a id="navbar-link" class="nav-link" href="{{route('topUsers')}}">Top Usuarios</a>
                        <a id="navbar-link" class="nav-link" href="{{ url('/contact') }}">Contacto</a>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesion</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Crear Cuenta </a>
                        </li>
                        @endif
                        @else
                        <li>
                            <div>
                                <img src="{{asset('img/cart.png')}}" class="carrito"></img>
                                @if(count(Cart::getContent()))
                                <!--Si hay productos en el carrito muestra un enlace con el numero de productos diferentes que tiene -->
                                <p>&nbsp<a href="{{route('cart.checkout')}}"><span class="badge badge-danger">{{count(Cart::getContent())}}</span></a></p>
                                @endif
                            </div>
                        </li>
                        <li>
                            @include('includes.avatar')
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nick }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/users/{{Auth::user()->id}}"><i class="fas fa-user"></i> Mi Perfil</a>
                                @if(Auth::user()->nick=="admin")
                                <a class="dropdown-item" href="/wines"><i class="fas fa-shopping-bag"></i> Productos</a>
                                <a class="dropdown-item" href="/users"><i class="fas fa-users"></i> Usuarios</a>
                                <a class="dropdown-item" href="/orders"> <i class="fas fa-dolly"></i> Pedidos</a>
                                @else
                                <a class="dropdown-item" href="/users/{{Auth::user()->id}}/edit"><i class="fas fa-edit"></i> Editar Perfil</a>
                                <a class="dropdown-item" href="{{route ('favourites')}}"><i class="fas fa-heart"></i> Mis Favoritos</a>
                                <a class="dropdown-item" href="/orders"><i class="fas fa-dolly"></i> Mis Pedidos</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="far fa-times-circle"></i> Salir
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </div>
</header>

<body>
    @yield('content')

    @yield('scripts')
</body>
<footer>
    <div class="container-fluid" style="margin-top:345px;">
        <div class="row">
            <div class="col-12">
                <br><br>
                <div class="row">
                    <ul class="col-2"></ul>
                    <ul class="col-xl-3- col-lg-3 col-md-3 col-sm-12 col-12 justify-content-center">Lo más buscado
                        <li><a style="text-decoration:none; color:white;" href="{{route('wine.tintos')}}">Tintos</a></li>
                        <li><a style="text-decoration:none; color:white;" href="{{route('wine.blancos')}}">Blancos</a></li>
                        <li><a style="text-decoration:none; color:white;" href="{{route('wine.rosados')}}">Rosados</a></li>
                    </ul>
                    <ul class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 justify-content-center">Los más Top
                        <li><a style="text-decoration:none; color:white;" href="{{route('topSumiller')}}">Top Sumiller</a></li>
                        <li><a style="text-decoration:none; color:white;" href="{{route('topUsers')}}">Top Usuarios</a></li>
                    </ul>
                    <ul class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 justify-content-center">Preguntanos
                        <li><a style="text-decoration:none; color:white;" href="{{route('contact.index')}}">Contacto</a></li>
                    </ul>
                    <ul class="col-1"></ul>
                </div>
                <div class="row">
                    <div class="col-12 justify-content-center">
                        <div style="text-align:center;font-size:x-large;"><a href="{{ url('/') }}"><img style="width:120px;" src="{{asset('img/new_logo.png')}}"></a>Siguenos en nuestras Redes: </img>
                            <img style="width:30px;margin-left:10px;" src="{{asset('img/twitter.png')}}" />
                            <img style="width:30px;margin-left:10px;" src="{{asset('img/facebook.png')}}" />
                            <img style="width:30px;margin-left:10px;" src="{{asset('img/instagram.png')}}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 justify-content-center">
                        <div style="text-align:center;font-size:small;">
                            <p>&#169 Alberto Ortega Fenández (Proyecto Final 2ºDaw)</p>
                            <p>I.E.S. Santiago Hernández</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</html>
