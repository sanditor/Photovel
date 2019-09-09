<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;

class CommentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function save(Request $request) {
        
        //Validacion
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);
        
        //Recoger datos
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        //Asigno los valors a mi nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        //Guardar en la BBDD
        $comment->save();
        
        //Redireccion
        return redirect()->route('image.detail', ['id' => $image_id])
                                  ->with([
                                        'message' => 'Has publicado tu comentario correctamente!!'
                                  ]);
    }
    
    public function  delete($id) {
        //conseguir datos del usuario logueado
        $user = \Auth::user();
        
        //Conseguir objeto del comentario
        $comment = Comment::find($id); 
        
        //comprobar si soy el dueno del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            
            //redireccion a la pagina de imagen del detalle en concreto 
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                                  ->with([
                                        'message' => 'Comentario eliminado correctament!!'
                                  ]);
        }else{
             return redirect()->route('image.detail', ['id' => $comment->image->id])
                                  ->with([
                                        'message' => 'El comentario no se ha eliminado!!'
                                  ]);
        }
    }

}
