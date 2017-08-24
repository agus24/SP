<?php

namespace Core;

use System\Route as RouteBase;

class Route
{
    public static $route;

    public static function init()
    {
        self::$route = RouteBase::instance(request());
    }

    public static function get($link,$controller)
    {
        self::$route->get($link, $controller);
    }

    public static function post($link,$controller)
    {
        self::$route->post($link, $controller);
    }

    public static function put($link,$controller)
    {
        self::$route->put($link, $controller);
    }

    public static function patch($link,$controller)
    {
        self::$route->patch($link, $controller);
    }

    public static function delete($link,$controller)
    {
        self::$route->delete($link, $controller);
    }

    public static function run()
    {
        return self::$route->end();
    }
}
