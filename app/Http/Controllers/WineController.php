<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\Wine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Like;
use App\Models\Favourite;

class WineController extends Controller
{
    function __construct()
    {
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Wine::class);
        $name = $request->name;
        $origin = $request->origin;
        $type = $request->type;
        $category= $request->category;
        $query = Wine::query(); 
        if (!empty($name)) {
            $wines = $query->where('name', 'like', "%$name%");
        }
        if (!empty($origin)) {
            $wines = $query->where('origin', 'like', $origin);
        }
        if (!empty($type)) {
            $wines = $query->where('type', 'like', $type);
        }
        if (!empty($category)) {
            $wines = $query->where('category', 'like', $category);
        }
        $wines = $query->paginate(15); //Recogemos los resultados del filtrado

        return view('wine.index', ['wines' => $wines,'name' => $name, 'origin' => $origin, 'type' => $type,'category'=>$category]);
    }

    public function create()
    {
        $this->authorize('create', Wine::class);
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

        //Asignar los nuevos valores al objeto de vino y redirige a la vista
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
            $newImage = time() . $image->getClientOriginalName(); //llamar a la imagen con el nombre del archivo que sube el admin para el vino
            Storage::disk('wines')->put($newImage, File::get($image)); // Guardar la imagen en la carpeta (storage/app/wines)
            $wine->image = $newImage;
        }
        $wine->save();
        return redirect('/wines')->with('status', 'Producto Añadido');
    }

    public function show(Wine $wine)
    {
        return view('wine.show', ['wine' => $wine]);
    }

    public function edit(Wine $wine)
    {
        $this->authorize('update', $wine);
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
            $newImage = time() . $image->getClientOriginalName(); //llamar a la imagen con el nombre del archivo que sube el admin para el vino
            Storage::disk('wines')->put($newImage, File::get($image)); // Guardar la imagen en la carpeta (storage/app/wines)
            $wine->image = $newImage;
        }
        $wine->save();
        return redirect('/wines')->with('status', 'Producto Actualizado');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $wine = Wine::find($id);
        $this->authorize('delete', Wine::class);
        Storage::disk('wines')->delete($wine->image);/*Borramos la imagen del vino del disco*/
        Like::where('wine_id', $id)->delete();/*Borramos sus likes*/
        Favourite::where('wine_id', $id)->delete();/*Borramos sus comentarios*/
        Wine::destroy($id);
        return back()->with('status', 'Producto Borrado');
    }

    public function getImage($filename)//Funcion para obtener la imagen del disco
    {
        $file = Storage::disk('wines')->get($filename);
        return new Response($file, 200);
    }
    public function tintos(Request $request)
    {
        $name = $request->name;
        $origin = $request->origin;
        $type = $request->type;
        $query = Wine::where('category', '=', 'Tinto'); //Filtrar todos los que su categoria sea Tinto
        if (!empty($name)) {
            $query = $query->where('name', 'like', "%$name%");
        }
        if (!empty($origin)) {
            $query = $query->where('origin', 'like', "%$origin%");
        }
        if (!empty($type)) {
            $query = $query->where('type', 'like', "%$type%");
        }
        $wines = $query->get(); //Recogemos los resultados del filtrado
        $wines = $query->paginate(9);
        return view('wine.tintos', ['wines' => $wines, 'name' => $name, 'origin' => $origin, 'type' => $type]);
    }
    public function rosados(Request $request)
    {
        $name = $request->name;
        $origin = $request->origin;
        $type = $request->type;
        $query = Wine::where('category', '=', 'Rosado'); //Filtrar todos los que su categoria sea Rosado
        if (!empty($name)) {
            $query = $query->where('name', 'like', "%$name%");
        }
        if (!empty($origin)) {
            $query = $query->where('origin', 'like', "%$origin%");
        }
        if (!empty($type)) {
            $query = $query->where('type', 'like', "%$type%");
        }
        $wines = $query->get(); //Recogemos los resultados del filtrado
        $wines = $query->paginate(9);
        return view('wine.rosados', ['wines' => $wines, 'name' => $name, 'origin' => $origin, 'type' => $type]);
    }
    public function blancos(Request $request)
    {
        $name = $request->name;
        $origin = $request->origin;
        $type = $request->type;
        $query = Wine::where('category', '=', 'Blanco'); //Filtrar todos los que su categoria sea Blanco
        if (!empty($name)) {
            $query = $query->where('name', 'like', "%$name%");
        }
        if (!empty($origin)) {
            $query = $query->where('origin', 'like', "%$origin%");
        }
        if (!empty($type)) {
            $query = $query->where('type', 'like', "%$type%");
        }
        $wines = $query->get(); //Recogemos los resultados del filtrado
        $wines = $query->paginate(9);
        return view('wine.blancos', ['wines' => $wines, 'name' => $name, 'origin' => $origin, 'type' => $type]);
    }
    public function topUsers()
    {
        //Consulta para obtener y ordenar por mayor numero de likes dados por los usuarios y los obtengo con valor wine_id
        $topwines = Wine::select(DB::raw('wine_id'))
            ->leftjoin('likes', 'wine_id', '=', 'wine_id')
            ->groupBy('wine_id')
            ->orderBy(DB::raw('COUNT(wine_id)'), 'DESC')
            ->take(9)->get();//obtiene solo 9,para mostrar en pantalla unicamente los 9 más votados

        $wines = Wine::all();

        return view('like.topusers', ['topwines' => $topwines, 'wines' => $wines]);
    }
}
