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
                        <form method="POST" action="">
                            @csrf

                            <input type="hidden" name="wine_id" value="{{$wine->id}}"/>
                            <p>
                                <p>Añadir Comentario</p>
                                <textarea class="form-control" name="content" required></textarea>
                            </p>
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </form>

                    </div>
                </div>
                <div class="card-footer">
                    @if(Auth::user()->nick=="admin")
                    <div><a class="btn btn-primary btn-md" style="float:left" href="/">Inicio</a>
                        <a class="btn btn-primary btn-md" style="float:right" href="/wines">Listado de productos</a>
                    </div>
                    @else
                    <div><a class="btn btn-primary btn-md" style="margin-left:45%;" href="/">Volver</a></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection