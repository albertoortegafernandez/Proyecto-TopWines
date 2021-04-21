<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }
    public function create()
    {
        return view('user.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'id'=>'required|integer|unique:users,id,',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:20|unique:users,nick,', // comprueba si existe algun nick con ese nombre
            'email' => 'required|string|email|max:25|unique:users,email,', //comprueba si existe algun email igual 
            'password'=>'required|string|min:6|confirmed',
        ];
        $request->validate($rules);
        // Recoger datos del formulario
        $id=$request->id;
        $name = $request->name;
        $surname = $request->surname;
        $nick = $request->nick;
        $email=$request->email;
        $password=$request->password;

        //Asignar los nuevos valores al objeto de vino y redirigir a la vista
        $user = new User;
        $user->id=$id;
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        $user->password=$password;
        $user->save();
        return redirect('/users');
    }
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }
    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }
    public function update(Request $request, User $user)
    {
        //Consigue el usuario identificado
        $user = Auth::user();
        $id = $user->id;
        //Validacion del formulario
        $rules = [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:20|unique:users,nick,' . $id, // comprueba si existe algun nick con ese nombre
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|integer',
            'city' => 'nullable|string|max:25',
            'phone_number' => 'nullable|integer',
            'email' => 'required|string|email|max:25|unique:users,email,' . $id, //comprueba si existe algun email igual 
        ];
        $request->validate($rules);
        // Recoger datos del formulario
        $name = $request->name;
        $surname = $request->surname;
        $nick = $request->nick;
        $postal_code = $request->postal_code;
        $address = $request->address;
        $city = $request->city;
        $phone_number = $request->phone_number;
        $email = $request->email;
        //Asignar los nuevos valores al objeto del usuario y redirigir a la vista del perfil
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->address = $address;
        $user->postal_code = $postal_code;
        $user->city = $city;
        $user->phone_number = $phone_number;
        $user->email = $email;
        //Subir imagen
        $avatar = $request->avatar;
        if ($avatar) {
            $newAvatar = time() . $avatar->getClientOriginalName(); //llamar a la imagen con el nombre del archivo que sube el usuario para su avatar

            Storage::disk('users')->put($newAvatar, File::get($avatar)); // Guardar la imagen en la carpeta (storage/app/users)
            $user->avatar = $newAvatar; //set de la imagen en el objeto
        }
        $user->update();
        return view('user.show', ['user' => $user]);
    }
    public function destroy($id)
    {
        User::destroy($id);
        $userlog=Auth::user();
        $idUserlog=$userlog->id;
        if($idUserlog!=1){
            return redirect('home')->with('status', 'Producto Borrado');//Si el usuario registrado no es el admin que lo devuelva al home
        }else{
            $users=User::all();
            return view ('user.index',['users'=>$users])->with('status', 'Producto Borrado');//si es admin a la vista de los usuarios registrados
        } 
    }
    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
