@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @if (Auth::user()->id==1)<!--Si el usuario es administrador-->
            <h2>Pedidos Registrados</h2>
            </br>
            <div class="row">
                        <div class="col-10 offset-2">
                            <div style="display:inline-block;">
                                <form class="form-inline" action="/orders" method="get">
                                    <input class="form-control" type="text" name="user_id" placeholder="ID del Usuario" value="{{$user_id}}">
                                    <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fas fa-search"></i> Filtrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
            @else<!-- Para los demás usuarios -->
            <h2>Mis Pedidos</h2>
            @endif
            </br>
            <div class="table-responsive-md">
                <div style="text-align:center;" class="row justify-content-center">
                    <div class="col-12">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <th>Código</th>
                                <th>ID Usuario</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Ver</th>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                @if(Auth::user()->id==$pedido->user_id)<!--Muestra los resultados del usuario logueado-->
                                <tr>
                                    <td>{{$pedido->codigo}}</td>
                                    <td>{{$pedido->user_id}}</td>
                                    <td>{{$pedido->total}}€</td>
                                    <td>{{($pedido->created_at)->format('d-m-Y')}}</td>
                                    <td><a class="btn btn-sm btn-outline-info" href="/orders/{{$pedido->id}}"><i class="fas fa-search"></i></a></td>
                                </tr>
                                @elseif (Auth::user()->id==1)<!--Si el usuario logueado es admin, muestra tododos los pedidos realizados por los usuarios -->
                                <tr>
                                    <td>{{$pedido->codigo}}</td>
                                    <td>{{$pedido->user_id}}</td>
                                    <td>{{$pedido->total}}€</td>
                                    <td>{{($pedido->created_at)->format('d-m-Y')}}</td>
                                    <td><a class="btn btn-sm btn-outline-info" href="/orders/{{$pedido->id}}"><i class="fas fa-search"></i></a></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-8 offset-4">{{$pedidos->links('pagination::bootstrap-4')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
