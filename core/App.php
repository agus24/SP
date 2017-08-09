<?php

namespace Core;

use Core\Auth;
use Core\Session;
use System\Route;

class App
{
    protected static $registry = [];

    public static function bind($key,$value)
    {
        static::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if(array_key_exists($key, static::$registry))
        {
            return static::$registry[$key];
        }

        throw new \Exception("no {$key} in Container");
    }

    public static function database()
    {
        return static::$registry['database'];

        throw new Exception("Database Not Configured");
    }

    public static function run()
    {
        Session::map($_SESSION);
        static::$registry['auth'] = new Auth(Session::get('user'));

        $route = Route::instance(request());
        require "app/routes.php";
        $route->end();
    }
}
