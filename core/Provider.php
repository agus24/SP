<?php

namespace Core;

use Core\App;

class Provider
{
    public static $providers;

    public static function init($provider)
    {
        static::$providers = $provider;
    }

    public static function boot()
    {
        foreach(static::$providers as $provider)
        {
            App::provider(new $provider);
        }
    }
}
