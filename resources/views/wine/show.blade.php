@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3 class=" text text-md-center text-uppercase ">{{$wine->name}} ({{$wine->type}})</h3></div>
                <div class="card-body">
                    <div><img id="imgWinePerfil" class="img img-fluid" src="{{route('wine.image',['filename'=>$wine->image])}}"></div>
                    <div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>ID: </strong> 
                                {{$wine->id}}
                            </li>
                            <li class="list-group-item"><strong>Nombre: </strong> 
                                {{$wine->name}}
                            </li>
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
                                {{$wine->description}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <div><a class="btn btn-primary btn-md" style="margin-left:40%;" href="/wines">Volver</a></div>
        </div>
    </div>
</div>
@endsection