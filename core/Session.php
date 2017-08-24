<?php
/**
 * Session - Manajemen session yang berjalan.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

namespace Core;

class Session
{
    /**
     * List Session yang ada
     * @var array
     */
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
     * Untuk mengambil semua data di container biasanya digunakan untuk debug
     * @return array list container
     */
    public static function getList()
    {
        return static::$container;
    }

    /**
     * Untuk mengisi value di container
     * @param string  $key
     * @param any  $value
     * @param boolean $flash
     */
    public static function set($key,$value,$flash = false)
    {
        $_SESSION[$key] = ["flash" => $flash, "count" => 0, "value" => $value];
    }

    /**
     * Untuk melakukan Flash pada session
     * @param  string $key   key emg harus string :)
     * @param  any $value isinya bisa bebas kok
     */
    public static function flash($key,$value)
    {
        static::set($key,$value,true);
    }

    /**
     * Untuk mapping Session dan menghapus Flash session
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
     * Untuk menghapus session, bila $key null maka akan menghapus semua session
     * @param  string $key
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

    /**
     * Untuk melakukan cek pada session jika session sudah kadaluarsa maka akan dipaksa logout
     * dan menghapus session tersebut
     * @return [type] [description]
     */
    public static function sessionCheck()
    {
        if(isset(static::$container['user']))
        {
            if(static::$container['logintime'] < time() - (App::get('config')['session_time'] * 60))
            {
                redirect('logout');
            }
        }
    }
}
