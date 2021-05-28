@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @if(session()->has('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <h2>Productos Disponibles</h2>
                    <br>
                    <div>
                        <div class="row">
                            <div class="col-12 ">
                                <div class="col-xl-12  col-md-12   col-12 " style="display:inline-block;">
                                    <form class="form-inline" action="/wines" method="get">
                                        <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fas fa-search"></i> Filtrar</button>
                                        <input class="form-control" type="text" name="name" placeholder="Nombre" value="{{$name}}">
                                        <select class="form-control" type="text" name="origin" value="{{$origin}}">
                                            <option value="">D.Origen</option>
                                            <option value="Rioja">Rioja</option>
                                            <option value="R.Duero">Ribera del Duero</option>
                                            <option value="Toro">Toro</option>
                                            <option value="Priorat">Priorat</option>
                                            <option value="Somontano">Somontano</option>
                                            <option value="Rias Baixas">Rías Baixas</option>
                                            <option value="Otros">Otros</option>
                                        </select>
                                        <select class="form-control" type="text" name="type"  value="{{$type}}">
                                            <option value="">Tipo</option>
                                            <option value="Joven">Joven</option>
                                            <option value="Tempranillo">Tempranillo</option>
                                            <option value="Crianza">Crianza</option>
                                            <option value="Reserva">Reserva</option>
                                            <option value="Gran Reserva">Gran Reserva</option>
                                        </select>
                                        <select class="form-control" type="text" name="category" value="{{$category}}">
                                            <option value="">Categoria</option>
                                            <option value="Tinto">Tinto</option>
                                            <option value="Rosado">Rosado</option>
                                            <option value="Blanco">Blanco</option>
                                        </select>
                                    </form>
                                    <div class=" float-right"><a href="/wines/create" class="btn btn-outline-primary">Añadir Nuevo</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </br>
            <div class="table-responsive-md">
                <div style="text-align:center;" class="row justify-content-center">
                    <div class="col-12">
                        <table class="table table-bordered table-hover table-striped  ">
                            <thead>
                                <th>Nombre</th>
                                <th>D.Origen</th>
                                <th>Categoria</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                                @foreach ($wines as $wine)
                                <tr>
                                    <td>{{$wine->name}}</td>
                                    <td>{{$wine->origin}}</td>
                                    <td>{{$wine->category}}</td>
                                    <td>{{$wine->type}}</td>
                                    <td>{{$wine->price}}</td>
                                    <td><a class="btn btn-sm btn-outline-info" href="/wines/{{$wine->id}}"><i class="fas fa-search"></i></a></td>
                                    <td><a class="btn btn-sm btn-outline-success" href="/wines/{{$wine->id}}/edit"><i class="fas fa-edit"></i></a></td>
                                    <td>
                                        <form action="/wines/{{$wine->id}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-outline-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </br>
            </div>
            <div class="row col-12 ">
                <div class="col-1 pagination-sm ">{{$wines->links('pagination::bootstrap-4')}}</div>
            </div>
        </div>
    </div>
</div>
@endsection