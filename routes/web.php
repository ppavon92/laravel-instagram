<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function() {

    //Usuarios
    Route::get('/home', 'UsersController@index');
    Route::get('/user/{username}', 'UsersController@show');//Muestra el perfil de un usuario en concreto
    Route::get('/user/delete', 'UsersController@destroy'); //No hace falta pasarles el id pq tenemos q estar logueados
    Route::get('/edituser', 'UsersController@edit');
    Route::post('/edituser', 'UsersController@update');
    Route::get('/logout', 'UsersController@logout');

    // Route::get('/login','LoginController.php');
    //  NO hay que hacerlo, lo gestiona el auth de laravel


    //Imágenes
    Route::get('/photoupload','ImagesController@create');
    Route::post('/photoupload','ImagesController@store');
    Route::get('/photo/delete/{id}', 'ImagesController@destroy');

    //Comentarios
    Route::post('/addcomment/{id}','ImagesController@comment');
    // Por get pero solo si el usuario esta registrado, a traves de un <a></a>
    Route::get('/deletecomment/{id}','ImagesController@deletecomment');

    //Likes
    Route::get('/like/{id}','ImagesController@like');
    // Por get pero solo si el usuario esta registrado, a traves de un <a></a>
    Route::get('/dislike/{id}','ImagesController@dislike');

});
Auth::routes();

// Redirigir a home si no esta logueado
Route::get('/', function(){
    return redirect('/login');
});







