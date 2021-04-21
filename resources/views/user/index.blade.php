@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h3 style="text-align:center;">Usuarios registrados en la web
                <div class="float-right"><a href="/users/create" class="btn btn-primary btn-sm">Añadir Nuevo</a></div>
            </h3>
            </br>
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Surname</th>
                    <th>Nick</th>
                    <th>Direccion</th>
                    <th>C.P</th>
                    <th>Ciudad</th>
                    <th>Nº Telefono</th>
                    <th>E-mail</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->surname}}</td>
                        <td>{{$user->nick}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->postal_code}}</td>
                        <td>{{$user->city}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->email}}</td>
                        <td><a class="btn btn-sm btn-info" href="/users/{{$user->id}}">Ver</a></td>
                        <td>
                            <form action="/users/{{$user->id}}" method="POST">
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