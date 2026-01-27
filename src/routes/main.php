<?php

use App\Http\Route;

Route::get('/', 'Homecontroller@index');
Route::post('/users/create', 'UsuarioController@store');
Route::post('/users/login', 'UsuarioController@login');
Route::get('/users/fetch', 'UsuarioController@fetch');
Route::put('/users/update', 'UsuarioController@update');
Route::delete('/users/{id}/delete', 'UsuarioController@delete');