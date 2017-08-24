<?php
/**
 * Provider
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

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
