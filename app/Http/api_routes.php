<?php

// Routes that need token
Route::group(['middleware' => ['before' => 'jwt.auth']], function () {


});

  // Recursos
  Route::resource('typedocuments', 'TypedocumentAPIController');
  Route::resource('photos', 'PhotoAPIController');
  Route::resource('documents', 'DocumentAPIController');
  Route::resource('users', 'UserAPIController');


// Obtener token con token existente (El mismo o uno refrescado)
Route::get('token', 'App\Http\Controllers\Auth\AuthController@token');

// Iniciar sesión
Route::post('login', 'SesionAPIController@store');

// Cerrar sesión
Route::get('logout', 'SesionAPIController@destroy');

// Registrar un usuario
Route::post('register', 'UserAPIController@register');

// Edita el usuario que esta en la sesión
Route::post('edit_register/{id}', 'UserAPIController@editRegister');

// valida que el correo no este ya registrado
Route::get('validate_user', 'UserAPIController@validateRepeatUser');

