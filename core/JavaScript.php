<?php

namespace Core;

use Core\Session;

class JavaScript
{
    private static $javascript = [];

    public static function instance()
    {
        return new static;
    }

    public static function addJS($js)
    {
        if(!is_int(array_search($js,static::$javascript)))
        {
            static::$javascript[] = $js;
        }
    }

    public static function getScript()
    {
        $script = '';
        foreach(static::$javascript as $key => $value)
        {
            $script .= "<script src='".$value."'></script>";
        }
        static::$javascript = [];
        return $script;
    }
}
