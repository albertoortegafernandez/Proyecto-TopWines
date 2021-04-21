@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Productos disponibles en la web
                <div class="float-right"><a href="/wines/create" class="btn btn-primary">Añadir Nuevo</a></div>
            </h3>
            </br>
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Origen</th>
                    <th>Categoria</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                </thead>
                <tbody>
                    @foreach ($wines as $wine)
                    <tr>
                        <td>{{$wine->id}}</td>
                        <td>{{$wine->name}}</td>
                        <td>{{$wine->origin}}</td>
                        <td>{{$wine->category}}</td>
                        <td>{{$wine->type}}</td>
                        <td>{{$wine->price}}</td>
                        <td><a class="btn btn-sm btn-info" href="/wines/{{$wine->id}}">Ver</a></td>
                        <td><a class="btn btn-sm btn-outline-success" href="/wines/{{$wine->id}}/edit">Editar</a></td>
                        <td>
                            <form action="/wines/{{$wine->id}}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input class="btn btn-sm btn-outline-danger" type="submit" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection