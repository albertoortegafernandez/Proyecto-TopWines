@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
<<<<<<< HEAD
        <div class="col-10 ">
=======
        <div class="col-10">
>>>>>>> nueva
            <h2>Mis Productos Favoritos</h2>
            </br>
            <div class="table-responsive-sm">
                <table style="text-align:center;" class="table table-hover table-bordered table-striped">
                    <thead>
                        <th>Nombre</th>
                        <th>Origen</th>
                        <th>Categoria</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Ver</th>
                    </thead>
                    <tbody>
                        @foreach ($favourites as $favourite)
                        @foreach ($wines as $wine )
                        @if($favourite->wine_id==$wine->id)
                        <tr>
                            <td>{{$wine->name}}</td>
                            <td>{{$wine->origin}}</td>
                            <td>{{$wine->category}}</td>
                            <td>{{$wine->type}}</td>
                            <td>{{$wine->price}}</td>
                            <td><a class="btn btn-sm btn-outline-info" href="/wines/{{$wine->id}}"><i class="fas fa-search"></i></a></td>
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection