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
        $wines=Wine::all();
        return view('home',['wines'=>$wines]);
    }

}
