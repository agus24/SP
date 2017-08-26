<?php
/**
 * App - Box untuk menyimpan applikasi yang ada.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

namespace Core;

use Core\Auth;
use Core\Contract\Provider;
use Core\Route;
use Core\Session;

class App
{
    /**
     * variabel box yang akan diisi.
     * @var array
     */
    protected static $registry = [];

    /**
     * untuk mengisi variabel registry
     * @param  string $key
     * @param  any $value
     */
    public static function bind($key,$value)
    {
        static::$registry[$key] = $value;
    }

    /**
     * untuk mengambil data dari registry
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
     * Untuk mengambil registry database
     * @return QueryBuilder
     */
    public static function database()
    {
        return static::$registry['database'];

        throw new Exception("Database Not Configured");
    }

    /**
     * Untuk mengambil registry config
     * @param  string $key
     * @return any
     */
    public static function config($key)
    {
        return static::$registry['config'][$key];
    }

    /**
     * untuk menjalankan aplikasi
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

    /**
     * Untuk Menjalankan Provider
     * @param  Provider $provider
     */
    public static function provider(Provider $provider)
    {
        $provider->boot();
    }

    /**
     * Untuk mengambil registry view
     * @return View
     */
    public static function view()
    {
        return static::$registry['view'];

        throw new Exception("View Not Configured");
    }
}
