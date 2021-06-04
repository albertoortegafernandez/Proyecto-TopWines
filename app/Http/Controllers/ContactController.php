<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }
    public function store(Request $request)
    {
        //Validación de los campos del formulario
        $request->validate([
            'name'=>'required|string|max:250',
            'surname'=>'required|string|max:250',
            'email'=>'required|string|email|max:25',
            'msg'=>'required|string|max:12500',
        ]);
        $correo=new ContactMail($request->all());//Recibo toda la informacion del formulario de contacto
        Mail::to('topwines.adm@gmail.com')->send($correo);//Envio esa informacion en el email

        return redirect()->route('contact.index')->with('status','Mensaje enviado correctamente. Pronto recibirá su respuesta, GRACIAS!!');
    }
}
