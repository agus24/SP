<?php
/**
 * Route - Core untuk melakukan routing pada aplikasi.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */
namespace Core;

use System\Route as RouteBase;

class Route
{
    /**
     * Variabel Route
     * @var RouteBase
     */
    public static $route;

    /**
     * Inisialisasi Route
     */
    public static function init()
    {
        self::$route = RouteBase::instance(request());
    }

    /**
     * Melakukan Routing dengan method GET
     * @param  String $link
     * @param  String $controller
     */
    public static function get($link,$controller)
    {
        self::$route->get($link, $controller);
    }

    /**
     * Melakukan Routing dengan method POST
     * @param  String $link
     * @param  String $controller
     */
    public static function post($link,$controller)
    {
        self::$route->post($link, $controller);
    }

    /**
     * Melakukan Routing dengan method PUT
     * @param  String $link
     * @param  String $controller
     */
    public static function put($link,$controller)
    {
        self::$route->put($link, $controller);
    }

    /**
     * Melakukan Routing dengan method PATCH
     * @param  String $link
     * @param  String $controller
     */
    public static function patch($link,$controller)
    {
        self::$route->patch($link, $controller);
    }

    /**
     * Melakukan Routing dengan method Delete
     * @param  String $link
     * @param  String $controller
     */
    public static function delete($link,$controller)
    {
        self::$route->delete($link, $controller);
    }

    /**
     * Menjalankan Route
     */
    public static function run()
    {
        return self::$route->end();
    }
}
