@extends('layouts.app')
@section('content')
<div class=container-fluid>
    <div class="row ">
        <div class="col-12 ">
            <div class="carruselImg">
                <div id="carouselImagenes" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class=" img img-fluid w-100 d-block " src="{{asset('img/carrusel_home1.jpg')}}" alt="0 slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h3 style="text-align:left;padding-bottom:80px;" class="d-block ">AMANTES DEL BUEN VINO</h3>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class=" img img-fluid d-block w-100" src="{{asset('img/carrusel_home.jpg')}}" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="img img-fluid d-block w-100" src="{{asset('img/carrusel_home3.jpg')}}" alt="three slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h3 style="text-align:left;padding-bottom:100px;" class="d-block ">Contacta con Nuestro Sumiller</h3>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselImagenes" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselImagenes" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row" style="margin-top:50px;">
        <div class="col-12 justify-content-center">
            <h2> Novedades </h2>
        </div>
    </div>
    <div class="row" style="margin-top:50px;">
        @foreach ($novedades as $nuevo)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 justify-content-center">
            <div class="card" id="cardWinePortada">
                <div class="card-header" id="headerPortada">
                    <a style="text-decoration:none; color:white;" href="/wines/{{$nuevo->id}}">
                        <h4 style="font-size: 18px;text-align: center;" class="text text-md-center text-uppercase ">{{$nuevo->name}}</h4>
                    </a>
                </div>
                <div id="cardbodyPortada" class="card-body">
                    <div>
                        <a href="/wines/{{$nuevo->id}}">
                            <img id="imgWinePortada" class="img img-fluid" src="{{route('wine.image',['filename'=>$nuevo->image])}}">
                        </a>
                    </div>
                </div>
                <div class="card-footer" id="cardFooterPortada">
                    <div id="precioPortada">
                        {{$nuevo->price}} €
                        <form action="{{route('cart.add')}}" method="POST">
                            @csrf
                            <input type="hidden" name="wine_id" value="{{$nuevo->id}}">
                            <input id="cantidadProduct" type="number" value="1" name="quantity" min="1" max="500">
                            <button id="carrito-btn" type="submit" class="btn btn-md btn-outline-warning"><i class="fas fa-cart-arrow-down"></i> Añadir</button>
                        </form>
                    </div>
                    <div>
                        <!--Si el usuario esta logueado-->
                        @if(Auth::user())
                        <!--Comprobar si el usuario ha dado like anteriormente-->
                        <?php $user_like = false; ?>
                        @foreach ($nuevo->likes as $like )
                        @if($like->user_id == Auth::user()->id)
                        <?php $user_like = true; ?>
                        @endif
                        @endforeach
                        @if($user_like)
                        <img class="btn-dislike" data-id="{{$nuevo->id}}" src="{{asset('img/like-blue.png')}}" />
                        @else
                        <img class="btn-like" data-id="{{$nuevo->id}}" src="{{asset('img/like-black.png')}}" />
                        @endif
                        @else
                        <img class="btn-like" src="{{asset('img/like-black.png')}}" />
                        @endif
                        <div id="contaLikes">{{count($nuevo->likes)}}</div>
                        <!--Si el usuario esta logueado-->
                        @if(Auth::user())
                        <!--Comprobar si el usuario ha dado favorito anteriormente-->
                        <?php $user_favourite = false; ?>
                        @foreach ($nuevo->favourites as $favourite )
                        @if($favourite->user_id == Auth::user()->id)
                        <?php $user_favourite = true; ?>
                        @endif
                        @endforeach
                        @if($user_favourite)
                        <img class="btn-quitFavourite" data-id="{{$nuevo->id}}" src="{{asset('img/heart-red.png')}}" />
                        @else
                        <img class="btn-favourite" data-id="{{$nuevo->id}}" src="{{asset('img/heart-black.png')}}" />
                        @endif
                        @else
                        <img class="btn-favourite" src="{{asset('img/heart-black.png')}}" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class=" shadow p-3 mb-5" style="display:inline-block;width:100%;background-color:#EACBC5;text-align:center;">
    <div class="row ">
        <div class="col-12 ">
            <div class="col-8 offset-3">
                <img class="img-fluid" style="float:left;width:280px;" src="{{asset('img/new_logo.png')}}" />
                <h3 style="float:left;font-size:35px;color:black;padding-top:70px;">Únete a Nuestra Comunidad
                    <br><br>
                    <p><a class="btn btn-md btn-outline-danger" href="{{route('register')}}">Regístrate</a></p>
                </h3>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row ">
        <div class="col-lg-12 col-12 ">
            <a class="col-lg-4 col-12" href="{{route('wine.tintos')}}"><img id="imgTipoWine" src="{{asset('img/categoria-tinto.jpg')}}" /></a>
            <a class="col-lg-4 col-12" href="{{route('wine.rosados')}}"><img id="imgTipoWine" src="{{asset('img/categoria-rosado.jpg')}}" /></a>
            <a class="col-lg-4 col-12" href="{{route('wine.blancos')}}"> <img id="imgTipoWine" src="{{asset('img/categoria-blanco.jpg')}}" /></a>
        </div>
    </div>
</div>
@endsection