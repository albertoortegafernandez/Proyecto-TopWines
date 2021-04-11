<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Wine;
use Illuminate\Http\Request;
use Illuminate\Http\File;

class WineController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    public function create()
    {
        return view('wine.create');
    }

    public function store(Request $request)
    {
        //Consigue el usuario identificado
        $user=Auth::user();
        $id=$user->id;
        
        $request->validate([
            'image'=>'required|string',
            'name'=>'required|regex:/^[\pL\s\-]+$/u|max:400',
            'origin'=>'required|string',
            'category'=>'required|string',
            'type'=>'required|string',
            'price'=>'required|numeric|max:5',
            'description'=>'required|string|max:200000',
            ]);

        // Recoger datos del formulario
        $image= $request->image;
        $name=$request->name;
        $origin=$request->origin;
        $category=$request->category;
        $type=$request->type;
        $price=$request->price;
        $description=$request->description;
        
        //Asignar los nuevos valores al objeto de vino y redirigir a la vista
        $wine=new Wine;
        $wine->image=$image;
        $wine->name=$name;
        $wine->origin=$origin;
        $wine->category=$category;
        $wine->type=$type;
        $wine->price=$price;
        $wine->description=$description;
        $wine->user_id=$id;
        $wine->save();
        return redirect('/wines');
    }

    public function show(Wine $wine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wine  $wine
     * @return \Illuminate\Http\Response
     */
    public function edit(Wine $wine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wine  $wine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wine $wine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wine  $wine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wine $wine)
    {
        //
    }
}
