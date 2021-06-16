<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
//importamos los usuarios
use App\User;
use App\Images;
//No necesitamos importar las imagenes porque la stamos utilizando desde los metodos que hemos establecido en el User.php user hasmany images

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            $images = Images::all() -> reverse();
            $user = $request -> user();

            return view('home', array(
                'images' => $images,
                'user' => $user,
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Le mandamos al formulario de registro
        // return view('userregister');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($username)
    {
        $user = User::where('username', $username)->first();

        //Si no encuentra al usuario que redirija a vista error
        if($user == null){
            return view('error');
        }
        return view('userprofile', array('user' => $user)); //asocio primero el nombre que se usa en la vista con la variable que usamos aqui
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //Le mandamos al formulario de edicion
        if (Auth::check()) {
            return view('userupdate');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //La id esta guardada de la sesion
        if (Auth::check()) {

            $user = $request -> user();

            if ($request->filled('name')) {
                //Si el campo esta relleno:
                $user -> name = $request->input('name');
            }
            if ($request->filled('username')) {
                $user -> username = $request->input('username');
            }
            if ($request->filled('email')) {
                $user -> email = $request->input('email');
            }
            if ($request->filled('password')) {
                $user -> password = $request->input('password');
            }
            $avatar = $request->file('avatar');
            if($avatar){
                //Borramos el avatar antiguo del storage
                $old_avatar = $user -> avatar;
                Storage::disk('avatars')->delete($old_avatar);
                //Nombre único
                $avatar_name = time().$avatar->getClientOriginalName();
                //Guardar en storage
                Storage::disk('avatars')->put($avatar_name, File::get($avatar));
                //Relacionamos nombre imagen con avatar de objeto usuario
                $user -> avatar = $avatar_name;

            }
            $user->save();
            return view('userprofile', array('user' => $user));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mirar como hacer esto
        if (Auth::check()) {
            $user = Auth::user();
            $user->delete();
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
