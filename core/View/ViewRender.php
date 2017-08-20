<?php

namespace Core\View;

class ViewRender
{
    public static $sectionName = "";
    public static $useName = "";
    public static $extName = "";
    public static function filterSection($section)
    {
        $section = preg_replace("(@section\(['\"])", '', $section);
        $section = preg_replace("(['\"']\))", '', $section);
        self::$sectionName = $section[0];
        return self::$sectionName;
    }

    public static function filterUse($use)
    {
        $use = preg_replace("(@use\(['\"])", '', $use);
        $use = preg_replace("(['\"']\))", '', $use);
        $use = preg_replace("(\.)", '/', $use);
        self::$useName = $use[0].".tpl";
        return self::$useName;
    }

    public static function filterExt($ext)
    {
        $ext = preg_replace("(@ext\(['\"])", '', $ext);
        $ext = preg_replace("(['\"']\))", '', $ext);
        $ext = preg_replace("(\.)", '/', $ext);
        self::$extName = $ext[0];
        return self::$extName;
    }
}
