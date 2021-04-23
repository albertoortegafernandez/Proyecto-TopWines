<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Wine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class WineController extends Controller
{
    function __construct()
    {
        
    }
    public function index()
    {
        $wines = Wine::all();

        return view('wine.index', ['wines' => $wines]);
    }

    public function create()
    {
        return view('wine.create');
    }

    public function store(Request $request)
    {
        //Consigue el usuario identificado
        $user = Auth::user();
        $id = $user->id;

        $request->validate([
            'image' => 'required|image',
            'name' => 'required|string|max:400',
            'origin' => 'required|string',
            'category' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string|max:200000',
        ]);

        // Recoger datos del formulario
        $name = $request->name;
        $origin = $request->origin;
        $category = $request->category;
        $type = $request->type;
        $price = $request->price;
        $description = $request->description;

        //Asignar los nuevos valores al objeto de vino y redirigir a la vista
        $wine = new Wine;
        $wine->name = $name;
        $wine->origin = $origin;
        $wine->category = $category;
        $wine->type = $type;
        $wine->price = $price;
        $wine->description = $description;
        $wine->user_id = $id;

        //Subir imagen
        $image = $request->image;
        if ($image) {
            $newImage = time() . $image->getClientOriginalName(); //llamar a la imagen con el nombre del archivo que sube el usuario para su avatar
            Storage::disk('wines')->put($newImage, File::get($image)); // Guardar la imagen en la carpeta (storage/app/users)
            $wine->image = $newImage;
        }
        $wine->save();
        return redirect('/wines')->with('status','Producto Añadido');
    }

    public function show(Wine $wine)
    {
        return view('wine.show', ['wine' => $wine]);
    }

    public function edit(Wine $wine)
    {
        return view('wine.edit', ['wine' => $wine]);
    }

    public function update(Request $request, Wine $wine)
    {
        $request->validate([
            'image' => 'required|image',
            'name' => 'required|string|max:400',
            'origin' => 'required|string',
            'category' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string|max:200000',
        ]);
        $wine->fill($request->all());
        //Subir imagen
        $image = $request->image;
        if ($image) {
            $newImage = time() . $image->getClientOriginalName(); //llamar a la imagen con el nombre del archivo que sube el usuario para su avatar
            Storage::disk('wines')->put($newImage, File::get($image)); // Guardar la imagen en la carpeta (storage/app/users)
            $wine->image = $newImage;
        }    
        $wine->save();
        return redirect('/wines')->with('status','Producto Actualizado');
    }

    public function destroy($id)
    {

        Wine::destroy($id);
        return back()->with('status','Producto Borrado');
    }

    public function getImage($filename)
    {
        $file = Storage::disk('wines')->get($filename);
        return new Response($file, 200);
    }
}
