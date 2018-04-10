<?php

#version
#dd(env('APP_VERSION'));
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

Route::get('/','PagesController@home');




Route::get ('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::get('/hometemple',function(){
	return view ('hometemple');
});
#login de usuarios
Route::get('login', function(){
	return 'pagina de login.';
});




/*
	vista por nombre de usuario.

 se le manda un parametro del usuario de la vista a la funcion.
Tambien con parametro opcional se utiliza ?, hay que pasarle un valor predeterminado.

where para agregar restricciones de caracteres que se envian.
*/

Route::get('usuario/{nombre?}', function($nombre='daniel'){
	return $nombre;
})-> where('nombre','[a-zA-z]+');

Route::get('usuarios', 'UserController@index')
	->name('users');
	//Devuelve a todos los usuarios.

# Detalles de un usuario
/* se colocca la condicion where para definir que solo que recibira numero en el id
y la ruta /usuarios/nuevo pueda funcionar.
 * */
Route::get('/usuarios/{user}', 'UserController@show')
    -> where('user', '[0-9]+')
    ->name('users.show');


#crear usuarios
Route::post('usuarios', function(){
	//Crea un nuevo usuario.
});

Route::get('/usuarios/nuevo', 'UserController@create')
	->name('users.create');

Route::post('/usuarios/crear', 'UserController@store');

Route::get('/usuarios/{user}/editar', 'UserController@edit')->name('users.edit');

Route::put('/usuarios/{user}','UserController@update');
#ruta con mas de un parametro

Route::get('saludo/{name}/{nickname?}', 'WelcomeUserController');

Route::delete('usuarios/{user}','UserController@destroy')
	->name('users.destroy');


#Route::get('/', function () {
 #   return view('welcome');
#});
