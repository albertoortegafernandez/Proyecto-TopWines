@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (Auth::user()->id==1)
            <h3 style="text-align:center;">Pedidos realizados por los usuarios</h3>
            @else
            <h3 style="text-align:center;">Mis Pedidos</h3>
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
                                @if(Auth::user()->id==$pedido->user_id)
                                <tr>
                                    <td>{{$pedido->codigo}}</td>
                                    <td>{{$pedido->user_id}}</td>
                                    <td>{{$pedido->total}}€</td>
                                    <td>{{($pedido->created_at)->format('d-m-Y')}}</td>
                                    <td><a class="btn btn-sm btn-outline-info" href="/orders/{{$pedido->id}}"><i class="fas fa-search"></i></a></td>
                                </tr>
                                @elseif (Auth::user()->id==1)
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