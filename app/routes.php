<?php

$route->get('', '\App\Controllers\LoginController@index');
$route->get('/login', '\App\Controllers\LoginController@index');
$route->post('/login', '\App\Controllers\LoginController@login');
$route->get('/logout', '\App\Controllers\LoginController@logout');
$route->get('/test', '\App\Controllers\BaseController@index');
