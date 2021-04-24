<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Wine;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       //
    }

    public function create()
    {
        //
    }

    public function save(Request $request)
    {
        $rules=[
            'wine_id'=>'required|integer',
            'comment'=>'required|string',
        ];
        $request->validate($rules);
        //Recoger datos
        $user=Auth::user();
        $wine_id=$request->input('wine_id');
        $content=$request->input('comment');//contenido del textarea(comentario)
        //Asignar valores a comentario
        $comment=new Comment();
        $comment->user_id=$user->id;
        $comment->wine_id=$wine_id;
        $comment->content=$content;
        $comment->save();

        return redirect()->back();
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy($id)
    {
        $user=Auth::user();
        $comment=Comment::find($id);

        //Comprobar si soy el dueño del comentario o si soy administrador, para poder borrarlo
        if($user &&($comment->user_id ==$user->id || $user->nick=='admin')){
            Comment::destroy($id);
            return back();
        }
        return back();
    }
}
