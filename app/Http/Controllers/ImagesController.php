<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Images;
use App\User;
use App\Likes;
use App\Comments;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photoupload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user = $request -> user();
            $image =  new Images();

            $image -> user_id = $user -> id;

            $new_image = $request->file('image');
            if($new_image){
                //Nombre único
                $image_name = time().$new_image->getClientOriginalName();
                //Guardar en storage
                Storage::disk('images')->put($image_name, File::get($new_image));
                //Relacionamos nombre imagen con new_image de objeto image
                $image -> image_path = $image_name;
            }

            if ($request->filled('description')) {
                $image -> description = $request->input('description');
            }
            //Guardamos y redirigimos a home
            $image->save();
            return redirect('/home');
        }
    }

    public function comment(Request $request, $id)
    {
        if (Auth::check()) {
            $user = $request -> user();
            $comment =  new Comments();

            $comment -> user_id = $user -> id;
            $comment -> image_id = $id;
            if ($request->filled('comment')) {
                $comment -> content = $request->input('comment');
            }
            //Guardamos y redirigimos al perfil
            $comment->save();

            // Si estoy en home que me devuelva a home y si no al perfil
            $prev = url()->previous();
            if (Str::contains($prev, 'home')) {
                return redirect('home');
            }
            else{
                return redirect('/user/'.$user->username);
            }
        }
    }

    public function deletecomment(Request $request, $id)
    {
        if (Auth::check()) {
            $user = $request -> user();
            $userid = $user->id;
            $delete = Comments::where([
                ['id', $id],
                ['user_id', $userid]
            ])->delete();

            // Si estoy en home que me devuelva a home y si no al perfil
            $prev = url()->previous();
            if (Str::contains($prev, 'home')) {
                return redirect('home');
            }
            else{
                return redirect('/user/'.$user->username);
            }
        }
    }



    public function like(Request $request, $id)
    {
        if (Auth::check()) {
            $user = $request -> user();
            $like =  new Likes();

            $like -> user_id = $user -> id;
            $like -> image_id = $id;

            //Guardamos
            $like->save();

            // Si estoy en home que me devuelva a home y si no al perfil
            $prev = url()->previous();
            if (Str::contains($prev, 'home')) {
                return redirect('home');
            }
            else{
                return redirect('/user/'.$user->username);
            }
        }
    }

    public function dislike(Request $request, $img_id)
    {
        if (Auth::check()) {
            $user = $request -> user();
            $userid = $user->id;
            $delete = Likes::where([
                ['image_id', $img_id],
                ['user_id', $userid]
            ])->delete();

            // Si estoy en home que me devuelva a home y si no al perfil
            $prev = url()->previous();
            if (Str::contains($prev, 'home')) {
                return redirect('home');
            }
            else{
                return redirect('/user/'.$user->username);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($img_id)
    {
        Images::where('id', $img_id)->delete();
        return redirect('/user/'.$user->username);

    }
}
