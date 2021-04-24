@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-xs-12 col-12">
            <div class="card" id="cardWinePerfil">
                <div class="card-header">
                    <h3 class=" text text-md-center text-uppercase ">{{$wine->name}} ({{$wine->type}})</h3>
                </div>
                <div class="card-body">
                    <div><img class="img img-fluid" id="imgWinePerfil" src="{{route('wine.image',['filename'=>$wine->image])}}"></div>
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
                            <p>Añadir Comentario</p>
                            <textarea class="form-control" name="comment"></textarea>
                            @error('comment')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            </p>
                            <button type="submit" class="btn btn-success">Enviar</button>
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
                    <div><a style="float:left" href="/">Inicio</a>
                        <a  style="float:right" href="/wines">Listado de productos</a>
                    </div>
                    @else
                    <div><a style="margin-left:45%;" href="/">Volver</a></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection