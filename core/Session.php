<?php

namespace Core;

class Session
{
    protected static $container = [];

    public static function get($key)
    {
        if(array_key_exists($key,Static::$container))
        {
            return static::$container[$key];
        }
        else
        {
            return null;
        }
    }

    public static function getList()
    {
        return static::$container;
    }

    public static function set($key,$value)
    {
        static::$container[$key] = $value;
    }

    public static function map($arr)
    {
        static::$container = $arr;
    }
}
