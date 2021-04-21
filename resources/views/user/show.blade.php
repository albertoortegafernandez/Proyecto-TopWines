@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div><img src="{{route('user.avatar',['filename'=>$user->avatar])}}" class="img img-fluid" id="imgUserPerfil"></div>
                </div>
                <div class="card-body">
                    <div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>ID: </strong>
                                {{$user->id}}
                            </li>
                            <li class="list-group-item"><strong>Nombre: </strong>
                                {{$user->name}}
                            </li>
                            <li class="list-group-item"><strong>Apellidos: </strong>
                                {{$user->surname}}
                            </li>
                            <li class="list-group-item"><strong>Nick: </strong>
                                {{$user->nick}}
                            </li>
                            <li class="list-group-item"><strong>Dirección: </strong>
                                {{$user->adress}}
                            </li>
                            <li class="list-group-item"><strong>C.P: </strong>
                                {{$user->postal_code}}
                            </li>
                            <li class="list-group-item"><strong>Ciudad: </strong>
                                {{$user->city}}
                            </li>
                            <li class="list-group-item"><strong>Nº Teléfono: </strong>
                                {{$user->phone_number}}
                            </li>
                            <li class="list-group-item"><strong>E-mail: </strong>
                                {{$user->email}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6 offset-md-4 ">
                            <div><a class="col-md-6 btn btn-primary btn-lg"  href="/users">Volver</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @if(Auth::user()->name!="administrador")
                <form action="/users/{{$user->id}}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input class="btn btn-sm btn-outline-danger" type="submit" style="float:right;" value="Eliminar Cuenta">
                </form>
            @endif
        </div>
    </div>
</div>
@endsection