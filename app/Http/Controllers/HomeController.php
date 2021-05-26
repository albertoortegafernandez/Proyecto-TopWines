<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wine;
use App\Models\Like;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class HomeController extends Controller
{

    public function __construct()
    {
        
    }
    public function index()
    {
        $novedades=Wine::latest()->take(3)->get();/*Obtener los ultimos 3 vinos añadidos*/
        //$wines=Wine::orderBy('id','asc')->paginate(9);/*Obtener todos los vinos*/
        return view('home',['novedades'=>$novedades]);
    }

}
