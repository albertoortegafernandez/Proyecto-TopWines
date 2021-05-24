@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-sm-12">
        <div class="jumbotron text-center col-12">
            <h1>Pedido realizado con éxito</h1>
            <p> El código de su pedido es: <strong>{{$order}}</strong></p>
            <br>
            <a href="{{route('home')}}" class="btn btn-md btn-outline-primary">Inicio</a> 
        </div> 
        </div>
    </div>
</div>
@endsection