@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <h3>Detalles del pedido con código: {{$order->codigo}}</h3>
            </br>
            <ul>
                <li>Nombre: {{$order->user->name}}</li>
                <li>Apellidos: {{$order->user->surname}}</li>
                <li>Direccion: {{$order->user->adress}}</li>
                <li>C.P: {{$order->user->postal_code}}</li>
                <li>Ciudad: {{$order->user->city}}</li>
                <li>Teléfono: {{$order->user->phone_number}}</li>
                <li>Email: {{$order->user->email}}</li>
            </ul>
            <div class="table-responsive text-center">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <th>Fecha del Pedido</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unidad</th>
                        
                    </thead>
                    <tbody>
                        @foreach($detalles as $producto)
                        <tr>
                            <td>{{($producto->created_at)->format('d-m-Y')}}</td>
                            <td>{{$producto->wine->name}}</td>
                            <td> {{$producto->quantity}}</td>
                            <td>{{$producto->wine->price}} €</td>
                        </tr>
                        @endforeach
                        <tr>
                                <td colspan="4"></td>
                                <td><strong>{{$order->subtotal}} €</strong></td>
                                <td id="detallePrecio">Total Compra</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                <td><strong>{{$order->total}} €</strong></td>
                                <td id="detallePrecio">Total Compra + Iva</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection