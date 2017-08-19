<?php
error_reporting(-1);
session_start();

use Core\App;
use Core\Session;
use Core\Auth;
use Core\Database\QueryBuilder;
use Core\Database\Connection;


require 'vendor/autoload.php';
require "core/handler/Error.php";

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));
