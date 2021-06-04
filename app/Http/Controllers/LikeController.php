<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Auth;


class LikeController extends Controller
{

    public function index()
    {
        $this->middleware('auth');
    }

    public function like($wine_id)
    {
        //Recoger datos del usuario y el vino
        $user = Auth::user();

        //Condicion para ver si ya existe el like de ese usuario para no duplicarlo
        $isset_like = Like::where('user_id', $user->id)->where('wine_id', $wine_id)->count();
        //Si el like es igual a 0
        if ($isset_like == 0) {
            $like = new Like(); //Creamos un nuevo like
            $like->user_id = $user->id; //Con el id del usuario
            $like->wine_id = (int)$wine_id; //Y el id del vino correspondiente
            //Guardar Base Datos
            $like->save();
            return response()->json([
                'like' => $like
            ]);
        } else { //Si ya existe el like devolvemos
            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }
    }

    public function dislike($wine_id)
    {
        //Recoger datos del usuario y el vino
        $user = Auth::user();

        //Condicion para ver si ya existe el like de ese usuario para no duplicarlo
        $like = Like::where('user_id', $user->id)->where('wine_id', $wine_id)->first();

        if ($like) {
            //Eliminar like
            $like->delete();
            return response()->json([
                'like' => $like,
                'message' => 'Has dado dislike correctamente'
            ]);
        } else {
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }
    }
}
