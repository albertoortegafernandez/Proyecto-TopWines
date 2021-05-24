@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-xs-12 col-12">
            <div class="card" id="cardWinePerfil">
                <div class="card-header">
                    <h4 class=" text text-md-center text-uppercase ">{{$wine->name}}</h4>
                </div>
                <div class="card-body">
                    <div><img class="img img-fluid" id="imgWinePerfil" src="{{route('wine.image',['filename'=>$wine->image])}}"></div>
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
                    <br><br>
                    <div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Origen: </strong>
                                {{$wine->origin}}
                            </li>
                            <li class="list-group-item"><strong>Categoria: </strong>
                                {{$wine->category}}
                            </li>
                            <li class="list-group-item"><strong>Tipo: </strong>
                                {{$wine->type}}
                            </li>
                            <li class="list-group-item"><strong>Precio: </strong>
                                {{$wine->price}}
                            </li>
                            <li class="list-group-item"><strong>Descripcion: </strong>
                                <p>{{$wine->description}}</p>
                            </li>
                            <li style="list-style:none;"></li>
                        </ul>
                    </div>
                    <br>
                    <div id="comentarioVino">
                        <h4 style="text-align:center;">Comentarios</h4>
                        <br>
                        <form method="POST" action="{{route('comment.save')}}">
                            @csrf

                            <input type="hidden" name="wine_id" value="{{$wine->id}}" />
                            <p>
                            <p>Dejanos tu Comentario</p>
                            <textarea class="form-control" name="comment"></textarea>
                            @error('comment')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            </p>
                            <button type="submit" class="btn btn-outline-success text-md-center">Añadir Comentario</button>
                        </form>
                        <hr>
                        @foreach ($wine->comments as $comment )
                        <div class="comment">
                            <span>@include('includes.userComent'){{' @'.$comment->user->nick}}</span>
                            <span>{{' | '.($comment->created_at)->format('d-m-Y')}}</span>
                            @if(Auth::check() &&($comment->user_id == Auth::user()->id || Auth::user()->nick=='admin'))
                            <span style="margin-top:0%;float:right;">
                                <form action="/comments/{{$comment->id}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input class="btn btn-sm btn-outline-danger" type="submit" value="Eliminar">
                                </form>
                            </span>
                            @endif
                            <p>{{$comment->content}}</p>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    @if(Auth::user()->nick=="admin")
                    <div><a class="btn btn-sm btn-outline-primary" style="float:left" href="/">Inicio</a>
                        <a style="float:right" href="/wines">Listado de productos</a>
                    </div>
                    @else
                    <div><a class="btn btn-outline-primary btn-sm"style="margin-left:45%;" href="/">Volver</a></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection