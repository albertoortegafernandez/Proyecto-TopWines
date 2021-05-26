@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-12" id="cabeceraUsuarios">
    <h2>Top</h2>
    <h2>de los</h2>
    <h2>Usuarios</h2>
</div>
</div>
<div class="container">
    <div class="row ">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <div class="row" style="margin-top:50px;">
                @foreach ($topwines as $topwine)<!--Obtengo el resultado de la consulta join con resultado de wine_id que es el id del vino-->
                @foreach ($wines as $wine)<!--recorro los vinos para obtener todo su contenido-->
                @if($topwine->wine_id == $wine->id )<!-- cuando sea el id igual al obtenido en la consulta de los likes, saco todo el contenido del vino-->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 justify-content-center">
                    <div class="card" id="cardWinePortada">
                        <div class="card-header" id="headerPortada">
                            <h4 class=" text text-md-center text-uppercase ">{{$wine->name}} </h4>
                        </div>
                        <div id="cardbodyPortada" class="card-body">
                            <div>
                                <a href="/wines/{{$wine->id}}">
                                    <img id="imgWinePortada" class="img img-fluid" src="{{route('wine.image',['filename'=>$wine->image])}}">
                                </a>
                            </div>
                        </div>
                        <div class="card-footer" id="cardFooterPortada">
                            <div id="precioPortada">
                                {{$wine->price}} €
                                <form action="{{route('cart.add')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="wine_id" value="{{$wine->id}}">
                                    <input id="cantidadProduct" type="number" value="1" name="quantity" min="1" max="500">
                                    <button id="carrito-btn" type="submit" class="btn btn-md btn-outline-warning"><i class="fas fa-cart-arrow-down"></i> Añadir</button>
                                </form>
                            </div>
                            <div>
                                <!--Si el usuario esta logueado-->
                                @if(Auth::user())
                                <!--Comprobar si el usuario ha dado like anteriormente-->
                                <?php $user_like = false; ?>
                                @foreach ($wine->likes as $like )
                                @if($like->user_id == Auth::user()->id)
                                <?php $user_like = true; ?>
                                @endif
                                @endforeach
                                @if($user_like)
                                <img class="btn-dislike" data-id="{{$wine->id}}" src="{{asset('img/like-blue.png')}}" />
                                @else
                                <img class="btn-like" data-id="{{$wine->id}}" src="{{asset('img/like-black.png')}}" />
                                @endif
                                @else
                                <img class="btn-like" src="{{asset('img/like-black.png')}}" />
                                @endif
                                <div id="contaLikes">{{count($wine->likes)}}</div>
                                <!--Si el usuario esta logueado-->
                                @if(Auth::user())
                                <!--Comprobar si el usuario ha dado favorito anteriormente-->
                                <?php $user_favourite = false; ?>
                                @foreach ($wine->favourites as $favourite )
                                @if($favourite->user_id == Auth::user()->id)
                                <?php $user_favourite = true; ?>
                                @endif
                                @endforeach
                                @if($user_favourite)
                                <img class="btn-quitFavourite" data-id="{{$wine->id}}" src="{{asset('img/heart-red.png')}}" />
                                @else
                                <img class="btn-favourite" data-id="{{$wine->id}}" src="{{asset('img/heart-black.png')}}" />
                                @endif
                                @else
                                <img class="btn-favourite" src="{{asset('img/heart-black.png')}}" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection