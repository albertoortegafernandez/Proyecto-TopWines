@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
            @endif
            <div class="card">
                <div class="card-header text-md-center"><h4>Añadir Nuevo Producto</h4></div>
                <div class="card-body">
                    <form method="POST" action="/wines" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Imagen: </label>
                            <div class="col-md-7">
                                <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" required />
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                            <div class="col-md-7">
                                <input id="name" type="text" name="name" class="form-control" value="{{old('name')}}" required />
                                @error('name')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="origin" class="col-md-4 col-form-label text-md-right">Denominación de Origen</label>
                            <div class="col-md-7">
                                <select class="form-control" id="origin" name="origin" value="{{old('origin')}}">
                                    <option value="Rioja">Rioja</option>
                                    <option value="R.Duero">Ribera del Duero</option>
                                    <option value="Somontano">Somontano</option>
                                    <option value="Toro">Toro</option>
                                    <option value="Priorat">Priorat</option>
                                    <option value="Rias Baixas">Rías Baixas</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Categoria</label>
                            <div class="col-md-7">
                                <select class="form-control" id="category" name="category" value="{{old('category')}}">
                                    <option value="Tinto">Tinto</option>
                                    <option value="Rosado">Rosado</option>
                                    <option value="Blanco">Blanco</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Tipo</label>
                            <div class="col-md-7">
                                <select class="form-control" id="type" name="type" value="{{old('type')}}">
                                    <option value="Joven">Joven</option>
                                    <option value="Tempranillo">Tempranillo</option>
                                    <option value="Crianza">Crianza</option>
                                    <option value="Reserva">Reserva</option>
                                    <option value="Gran Reserva">Gran Reserva</option>
                                    <option value="Albarinio">Albariño</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Precio</label>
                            <div class="col-md-7">
                                <input id="price" type="text" name="price" class="form-control" value="{{old('price')}}" required />
                                @error('price')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-7">
                                <input id="description" name="description" type="text" class="form-control" value="{{old('description')}}" required />
                                @error('description')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-7 offset-md-5">
                                <input type="submit" class="btn btn-outline-primary" value="Añadir Producto">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection