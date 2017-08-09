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

    public static function set($key,$value,$flash = false)
    {
        $_SESSION[$key] = ["flash" => $flash, "count" => 0, "value" => $value];
    }

    public static function flash($key,$value)
    {
        static::set($key,$value,true);
    }

    public static function map($arr)
    {
        $new_arr = [];
        $flash_list = [];
        foreach($arr as $key => $val)
        {
            $val['count'] = isset($val['count']) ? $val['count'] : 0;
            if(!($val['count'] > 0 && $val['flash']))
            {
                $val['count']++;
                $new_arr[$key] = $val;
            }
        }
        static::$container = $new_arr;
        $_SESSION = static::$container;
    }

    public static function flush($key = null)
    {
        if($key == null)
        {
            session_destroy();
        }
        else
        {
            session_unset($key);
        }
    }
}
