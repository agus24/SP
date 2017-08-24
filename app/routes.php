<?php

use Core\Route;

Route::get('', '\App\Controllers\LoginController@index');
Route::get('/login', '\App\Controllers\LoginController@index');
Route::post('/login', '\App\Controllers\LoginController@login');
Route::get('/logout', '\App\Controllers\LoginController@logout');

Route::get('/user', '\App\Controllers\BaseController@index');
Route::get('/user/{id}/edit', '\App\Controllers\BaseController@edit');
