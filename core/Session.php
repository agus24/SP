<?php

namespace Core;

class Session
{
    protected static $container = [];

    /**
     * ambil session container sesuai key
     * @param  string $key
     * @return any      data di dalem containernya
     */
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

    /**
     * bwt ambil semua data di container, biasanya gw pake bwt debug, tp gtw dah yg laen mw pake gmn
     * @return array list container
     */
    public static function getList()
    {
        return static::$container;
    }

    /**
     * bwt ngisi valuenya coeg
     * @param string  $key   key emg harus string :)
     * @param any  $value isinya bisa bebas kok :)
     * @param boolean $flash default false gunanya klo true jadinya session cuma bisa di pake 1x doang
     */
    public static function set($key,$value,$flash = false)
    {
        $_SESSION[$key] = ["flash" => $flash, "count" => 0, "value" => $value];
    }

    /**
     * ini bwt flashnya gw gtw knp gw buat misah pdhl pake fungsi set jg bisa -_-
     * @param  string $key   key emg harus string :)
     * @param  any $value isinya bisa bebas kok
     */
    public static function flash($key,$value)
    {
        static::set($key,$value,true);
    }

    /**
     * bwt mapping dari session di php bwt di taro di container class ini lalu di remap skalian apus yg flash data
     * @param  array $arr session php
     */
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

    /**
     * bwt session destroy ini. pdhl pake session biasa jg bisa. gw cuma gtw aja knp gw buat ini tp yasudahlah
     * @param  string $key biasanya sih emg string tp kadang ada yg integer. sesuka org yg pake aja nanti
     */
    public static function flush($key = null)
    {
        if($key == null)
        {
            session_destroy();
        }
        else
        {
            unset($_SESSION[$key]);
        }
    }
}
