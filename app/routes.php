<?php

use Core\Route;
Route::init();

Route::get('', '\App\Controllers\LoginController@index');

Route::run();
// $route->get('/login', '\App\Controllers\LoginController@index');
// $route->post('/login', '\App\Controllers\LoginController@login');
// $route->get('/logout', '\App\Controllers\LoginController@logout');
// $route->get('/test', '\App\Controllers\BaseController@index');
