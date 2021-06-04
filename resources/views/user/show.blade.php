@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div id="fotoPerfil" class="card-header">
                            <div><img src="{{route('user.avatar',['filename'=>$user->avatar])}}" class="img img-fluid" id="imgUserPerfil"></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <ul class="list-group list-group-flush">
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
                    @if(Auth::user()->nick=="admin")
                    <div><a class="btn btn-sm btn-outline-primary" style="float:left" href="/">Inicio</a>
                        <a style="float:right" href="/users">Listado de usuarios</a>
                    </div>
                    @else
                    <div><a class="btn btn-outline-primary btn-sm" style="margin-left:45%;" href="/">Inicio</a></div>
                    @endif
                </div>
            </div>
            <br>
            @if(Auth::user()->name!="administrador")
            <td>
                <button class="btn btn-sm btn-outline-danger" type="button" data-toggle="modal" data-target="#modalCentered" style="float:right;"><i class="fas fa-trash-alt"></i> Eliminar Cuenta</button>
                <!-- Modal -->
                <div class="modal" id="modalCentered" tabindex="-1" role="dialog" aria-labelledby="modalCenteredLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenteredLabel">Aviso</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Esta seguro de eliminar su cuenta definitivamente
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <form action="/users/{{$user->id}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-outline-danger" type="submit"><i class="fas fa-trash-alt"></i> Si, estoy seguro</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            @endif
        </div>
    </div>
</div>
@endsection
