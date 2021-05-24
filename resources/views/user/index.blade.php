@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('status'))
            <div class="justify-content-center col-md-6 alert alert-success">
                {{session('status')}}
            </div>
            @endif
            <div class="row">
                <div class="col-10">
                    <h3 style="text-align:center;">Usuarios registrados en la web</h3>
                </div>
            </div>
            </br>
            <div class="table-responsive-md">
                <div style="text-align:center;" class="row justify-content-center">
                    <div class="col-12">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Nick</th>
                                <th>Direccion</th>
                                <th>C.P</th>
                                <th>Ciudad</th>
                                <th>Teléfono</th>
                                <th>E-mail</th>
                                <th>Ver</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->surname}}</td>
                                    <td>{{$user->nick}}</td>
                                    <td>{{$user->adress}}</td>
                                    <td>{{$user->postal_code}}</td>
                                    <td>{{$user->city}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><a class="btn btn-sm btn-outline-info" href="/users/{{$user->id}}"><i class="fas fa-search"></i></a></td>
                                    <td>
                                        <form action="/users/{{$user->id}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-outline-danger" type="submit"><i class="fas fa-trash-alt"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-8 offset-4">{{$users->links('pagination::bootstrap-4')}}</div>
        </div>
    </div>
</div>
@endsection