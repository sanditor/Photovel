<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {

        //Validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);

        //Recoger datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Asignar valores al nuevo objeto
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        //subir fichero
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        //Guardar imagen en BBDD
        $image->save();

        return redirect()->route('home')->with([
            'message' => 'La foto ha sido subida correctamente!!'
        ]);
    }

    //mostrar imagen en card-body
    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    //pagina de detalle
    public function detail($id)
    {
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();


        if ($user && $image && $image->user->id == $user->id) {

            //Eliminar comentarios
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    //borrar objeto del ORM y BBDD
                    $comment->delete();
                }
            }

            //Eliminar los likes
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    //borrar objeto del ORM y BBDD
                    $like->delete();
                }
            }

           //Eliminar Ficheros de imagen guardada en el Storage del Disco de Imagenes
            // Subir fichero
            /* if ($image_path) {
            Storage::disk('images')->delete($image->image_path);
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        } */

            Storage::disk('images')->delete($image->image_path);

            //Eliminar registro imagen
            $image->delete();

            $message = array('message' => 'La imagen se ha borrado correctamente!!');
        } else {
            $message = array('message' => 'La imagen no se ha borrado!!');
        }

        //redireccion al home y le pasa el mensaje al usuario

        return redirect()->route('home', ['id' => $user->id])->with($message);
    }

    public function edit($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);

        //comprobar si el usuario es dueno de la publicacion e imagen
        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', [
                'image' => $image
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function  update(Request $request)
    {

        //Validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'image'
        ]);
        //Recoger los datos del formulario
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Conseguir objeto image y settear la nueva informacion
        $image = Image::find($image_id);
        $image->description = $description;

        //subir fichero
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        //Actualizar registro
        $image->update();

        //redireccion a la ruta del detalle de la imagen
        return redirect()->route('image.detail', ['id' => $image_id])
            ->with([
                'message' => 'Imagen Actualizada con exito'

            ]);
    }
}
