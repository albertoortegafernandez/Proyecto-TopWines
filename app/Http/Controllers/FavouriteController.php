<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Auth;
use App\Models\Wine;
use App\Models\User;

class FavouriteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('favouritesSumiller');
    }

    public function showFavourites(){
        $user=Auth::user();
        $wines=Wine::all();
        $favourites=Favourite::where('user_id',$user->id)->orderBy('id','desc')->get();/*ordenar por id mayor*/
        return view ("favourite.favourites",['favourites'=>$favourites,'wines'=>$wines]);
    }

    public function favourite($wine_id)
    {
        //Recoger datos del usuario y el vino
        $user = Auth::user();
       
        //Condicion para ver si ya existe el favorito de ese usuario para no duplicarlo
        $isset_favourite = Favourite::where('user_id', $user->id)->where('wine_id', $wine_id)->count();

        if ($isset_favourite == 0) {//Si es igual a 0 añade el favorito

            $favourite = new Favourite;
            $favourite->user_id = $user->id;
            $favourite->wine_id = (int)$wine_id;
            //Guardar Base Datos
            $favourite->save();

            return response()->json([
                'favourite' => $favourite
            ]);
        } else {
            return response()->json([
                'message' => 'El favorito ya existe'
            ]);
        }
    }

    public function quitFavourite($wine_id)
    {
        //Recoger datos del usuario y el vino
        $user = Auth::user();

        //Condicion para ver si ya existe el favorito de ese usuario para no duplicarlo
        $favourite = Favourite::where('user_id', $user->id)->where('wine_id', $wine_id)->first();

        if ($favourite) {

            //Eliminar like
            $favourite->delete();

            return response()->json([
                'favourite' => $favourite,
                'message' => 'Has quitado tu favorito correctamente'
            ]);
        } else {
            return response()->json([
                'message' => 'El favorito no existe'
            ]);
        }
    }
    public function favouritesSumiller(){
        $id=2;//Id del sumiller
        $user=User::find($id);//Obtengo todos los datos de sumiller
        $favourites=Favourite::where('user_id',$user->id)->get();//Selecciono todos sus favoritos        
        $wines=Wine::query()->paginate(9);//Obtengo los datos de los vinos 
        return view ("favourite.topSumiller",['wines'=>$wines,'favourites'=>$favourites]);
    }

}
