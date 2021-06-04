@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center ">
            @if(count(Cart::getContent()))
            <!--Si hay contenido en el carrito -->
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div style="text-align:center;" class="card-header">
                            <h4> Datos del Usuario</h4>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Nombre: {{$user->name}}</li>
                                <li>Apellidos: {{$user->surname}}</li>
                                <li>Dirección: {{$user->adress}}</li>
                                <li>C.P: {{$user->postal_code}}</li>
                                <li>Ciudad: {{$user->city}}</li>
                                <li>Teléfono: {{$user->phone_number}}</li>
                                <li>Email: {{$user->email}}</li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-md btn-outline-success " href="/users/{{Auth::user()->id}}/edit">Modificar Datos</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
                    <h2 class="text-center">Resumen de Compra</h2>
                    <table class="table table-stripped">
                        <thead>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>D.Origen</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach (Cart::getcontent() as $wine)
                            <!-- Recorremos los productos que hay en el carrito  -->
                            <tr>
                                <td>{{$wine->name}}</td>
                                <td>{{$wine->quantity}}</td>
                                <td>{{$wine->attributes->origin}}</td>
                                <td>{{$wine->attributes->category}}</td>
                                <td>{{$wine->price}}</td>
                                <td>
                                    <form action="{{route('cart.removeproduct')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$wine->id}}">
                                        <button type="submit" class="btn btn-link btn-sm text-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4"></td>
                                <td>{{number_format(Cart::getSubtotal(),2)}}€</td>
                                <!--Obtenemos el resultado con 2 decimales -->
                                <td>Total Compra</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td> x 21%</td>
                                <td>Iva</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                <td><strong>{{number_format((Cart::getSubtotal()*1.21),2)}}€</strong></td>
                                <td>Total Compra + Iva</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-4 p-4">
                            <form action="{{route('cart.delete')}}" method="POST">
                                @csrf
                                <button type="submit" class="btn  btn-outline-danger rounded-pill mx-auto d-block">Vaciar Carrito</button>
                            </form>
                        </div>
                        <div class="col-sm-8 p-4">
                            <form action="{{route('cart.procesopedido')}}" method="POST">
                                @csrf
                                <button type="submit" class="btn  btn-outline-primary rounded-pill mx-auto d-block">Realizar Pedido</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- Si el carrito esta vacio -->
            <div class="jumbotron text-center col-12" style="background-color: #EACBC5;">
                <h2>Su carrito está vacio</h2>
                <br>
                <a href="{{route('home')}}" class="btn btn-outline-danger">Seguir Comprando</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
