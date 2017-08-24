<?php

namespace Core;

use Core\Auth;
use Core\Interfaces\Provider;
use Core\Route;
use Core\Session;
// use System\Route;

/**
 * App Container Class For Booting And "Things" ?
 * maybe i can do a lot of improvement here (maybe)
 */
class App
{
    /**
     * @var array
     */
    protected static $registry = [];

    /**
     * masukin key sama value ke registry
     * @param  string $key
     * @param  any $value
     */
    public static function bind($key,$value)
    {
        static::$registry[$key] = $value;
    }

    /**
     * ambil data dari registry sesuai key
     * @param  string $key
     * @return any
     */
    public static function get($key)
    {
        if(array_key_exists($key, static::$registry))
        {
            return static::$registry[$key];
        }

        throw new \Exception("no {$key} in Container");
    }

    /**
     * ambil databasenya
     * @return QueryBuilder
     */
    public static function database()
    {
        return static::$registry['database'];

        throw new Exception("Database Not Configured");
    }

    /**
     * get config
     * @param  string $key
     * @return any
     */
    public static function config($key)
    {
        return static::$registry['config'][$key];
    }

    /**
     * session, route, request, auth di declare di sini
     */
    public static function run()
    {
        Session::map($_SESSION);
        static::bind('auth', new Auth(Session::get('user')));
        Session::sessionCheck();
        Route::init();
        require "app/routes.php";
        Route::run();
    }

    public static function provider(Provider $provider)
    {
        $provider->boot();
    }

    /**
     * get View Instance
     * @return View
     */
    public static function view()
    {
        return static::$registry['view'];
    }
}
