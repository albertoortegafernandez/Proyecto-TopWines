<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function update(Request $request)
    {
        //Consigue el usuario identificado
        $user=Auth::user();
        $id=$user->id;
        //Validacion del formulario
        $rules=[
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:20|unique:users,nick,'.$id,// comprueba si existe algun nick con ese nombre
            'address'=> 'required|string|max:255',
            'postal_code'=>'required|integer',
            'city'=>'required|string|max:25',
            'phone_number'=>'required|integer',
            'email' => 'required|string|email|max:25|unique:users,email,'.$id,//comprueba si existe algun email igual 
        ];
        $request->validate($rules);

        // Recoger datos del formulario
        $name= $request->name;
        $surname=$request->surname;
        $nick=$request->nick;
        $postal_code=$request->postal_code;
        $address=$request->address;
        $city=$request->city;
        $phone_number=$request->phone_number;
        $email=$request->email;

        //Asignar los nuevos valores al objeto del usuario y redirigir a la vista del perfil
        $user->name=$name;
        $user->surname=$surname;
        $user->nick=$nick;
        $user->address=$address;
        $user->postal_code=$postal_code;
        $user->city=$city;
        $user->phone_number=$phone_number;
        $user->email=$email;

        //Subir imagen
        $avatar=$request->avatar;
        if($avatar){
            $newAvatar=time().$avatar->getClientOriginalName();//llamar a la imagen con el nombre del archivo que sube el usuario para su avatar
            
            Storage::disk('users')->put($newAvatar, File::get($avatar));// Guardar la imagen en la carpeta (storage/app/users)
            $user->avatar=$newAvatar;//set de la imagen en el objeto
        }
        $user->update();
        return redirect('perfil')->with(['message'=>'Usuario actualizado correctamente']);
    }

    public function getImage($filename)
    {
        $file=Storage::disk('users')->get($filename);
        return new Response($file,200);

    }
}
