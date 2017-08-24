<?php
/**
 * Javascript - Untuk memanajemen javascript pada view.
 * sehingga hanya beberapa javascript yang akan dijalankan pada view.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */
namespace Core;

use Core\Session;

class JavaScript
{
    /**
     * Variable tempat menyimpan list javascript.
     * @var array
     */
    private static $javascript = [];

    /**
     * Untuk menambahkan file javascript.
     * @param string $js
     */
    public static function addJS($js)
    {
        if(!is_int(array_search($js,static::$javascript)))
        {
            static::$javascript[] = $js;
        }
    }

    /**
     * Untuk mengubah list Javascript menjadi html.
     * @return string
     */
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
