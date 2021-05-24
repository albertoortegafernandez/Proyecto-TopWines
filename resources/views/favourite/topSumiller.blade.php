@extends('layouts.app')
@section('content')
<div id="cabeceraSumiller">
    <h2>Top</h2>
    <p>DEL</p>
    <h2>Sumiller</h2>
</div>
<div class="container">
    <div class="row ">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <div class="row" style="margin-top:50px;">
                @foreach ($favourites as $favourite)
                @foreach ($wines as $wine )
                @if($favourite->wine_id==$wine->id)
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
            <div class="col-8 offset-4">{{$wines->links('pagination::bootstrap-4')}}</div>
        </div>
    </div>
</div>
@endsection