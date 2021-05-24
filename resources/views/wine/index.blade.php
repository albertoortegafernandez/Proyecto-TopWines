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
                <div class="col-10">
                    <h3 style="text-align:center;">Productos disponibles en la web</h3>
                    <div class="float-right"><a href="/wines/create" class="btn btn-outline-primary">Añadir Nuevo</a></div>

                </div>
            </div>
            </br>
            <div class="table-responsive-md">
                <div style="text-align:center;" class="row justify-content-center">
                    <div class="col-12">
                        <table class="table table-bordered table-hover table-striped  ">
                            <thead>
                                <th>Nombre</th>
                                <th>Origen</th>
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
            </div>
            <div class="col-8 offset-4">{{$wines->links('pagination::bootstrap-4')}}</div>
        </div>
    </div>
</div>
@endsection