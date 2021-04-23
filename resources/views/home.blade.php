@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <div class="row">
                @foreach ($wines as $wine)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 justify-content-center">
                    <div class="card" id="cardWinePortada">
                        <div class="card-header" id="headerPortada">
                            <h4 class=" text text-md-center text-uppercase ">{{$wine->name}} ({{$wine->type}})</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <a href="/wines/{{$wine->id}}">
                                    <img id="imgWinePortada" class="img img-fluid" src="{{route('wine.image',['filename'=>$wine->image])}}">
                                </a>
                            </div>
                        </div>
                        <div class="card-footer" id="cardFooterPortada">
                            <div id="precioPortada">
                                {{$wine->price}} € <a class="btn btn-outline-warning btn-sm" href="#">Comprar</a>
                            </div>
                            <div>
                                <div id="like"><a href="#"><img src="{{asset('img/like-black.png')}}"></a></div>
                                <div id="contaLikes">({{$wine->num_likes}})</div>
                                <div id="favorito"><a href="#"><img src="{{asset('img/heart-black.png')}}"></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection