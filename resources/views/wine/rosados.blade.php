@extends('layouts.app')
@section('content')
<div id="cabeceraRosado">
<p>VINOS</p>
<h2>Rosados</h2>
</div>
<div class="container-fluid shadow p-3 mb-5" style="display:inline-block;background-color:#EACBC5;">
    <div class="row">
        <div class="col-12">
            <div class="col-xl-8 offset-xl-3 col-md-10 offset-md-2  col-12  justify-content-center">
                <form class="form-inline" action="/rosados" method="get">
                    <input class="form-control" type="text" name="name" placeholder="Nombre" value="{{$name}}">
                    <select class="form-control" type="text" name="origin" placeholder="Denominación origen" value="{{$origin}}">
                        <option value="">...</option>
                        <option value="Rioja">Rioja</option>
                        <option value="R.Duero">Ribera del Duero</option>
                        <option value="Valdepenyas">Valdepeñas</option>
                        <option value="Priorat">Priorat</option>
                        <option value="Somontano">Somontano</option>
                        <option value="Rias Baixas">Rías Baixas</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <select class="form-control" type="text" name="type" placeholder="Tipo" value="{{$type}}">
                        <option value="">...</option>
                        <option value="Joven">Joven</option>
                        <option value="Tempranillo">Tempranillo</option>
                        <option value="Crianza">Crianza</option>
                        <option value="Reserva">Reserva</option>
                        <option value="Gran Reserva">Gran Reserva</option>
                    </select>
                    <button class="btn btn-outline-danger btn-md" type="submit"><i class="fas fa-search"></i> Buscar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container">
    <div class="row" style="margin-top:50px;">
        @foreach ($wines as $wine)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 justify-content-center">
            <div class="card" id="cardWinePortada">
                <div class="card-header" id="headerPortada">
                    <h4 class=" text text-md-center text-uppercase ">{{$wine->name}}</h4>
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
        @endforeach
    </div>
    {{$wines->links('pagination::bootstrap-4')}}
</div>
</div>
</div>
@endsection