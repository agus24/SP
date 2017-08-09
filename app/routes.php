<?php

$route->get('', '\App\Controllers\LoginController@index');
$route->get('/login', '\App\Controllers\LoginController@index');
$route->post('/login', '\App\Controllers\LoginController@login');
$route->get('/logout', '\App\Controllers\LoginController@logout');

$route->get('user', '\App\Controllers\UserController@index');
$route->post('user', '\App\Controllers\UserController@store');
$route->get('user/{id}', '\App\Controllers\UserController@get');
$route->get('user/{id}/edit', '\App\Controllers\UserController@edit');
$route->post('user/{id}/edit', '\App\Controllers\UserController@update');
$route->get('user/{id}/delete', '\App\Controllers\UserController@delete');
