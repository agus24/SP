<?php
/**
 * Helper - Fungsi-fungsi global yang dapat digunakan di semua modul.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

use Core\App;
use Core\JavaScript;
use Core\Session;
use Core\View\View;
use System\Request;

/**
 * Untuk melakukan Extract variable dan menghentikan aplikasi yang berjalan.
 */
if(!function_exists('dd'))
{
    function dd($var)
    {
        die(var_dump($var));
    }
}

/**
 * Untuk mengambil request yang dikirimkan oleh user.
 */
if(!function_exists('request'))
{
    function request()
    {
        return $request = Request::instance();
    }
}

/**
 * Untuk membuat URL menuju ke page tertentu.
 */
if(!function_exists('makeUrl'))
{
    function makeUrl($link)
    {
        $php = $_SERVER['PHP_SELF'];
        $base = explode("index.php",$php)[0];
        return
                // $_SERVER['REQUEST_SCHEME'].
                "http://".
                $_SERVER['HTTP_HOST'].
                $base.
                $link
                ;
    }
}

/**
 * Alias untuk App::view().
 */
if(!function_exists('view'))
{
    function view($bind,$variables = [])
    {
        $sections = explode('.', $bind);
        $view = App::view()->make($sections[0],$sections[1]);
        foreach($variables as $key => $value)
        {
            $view->share($key,$value);
        }
        return $view->render();
    }
}

/**
 * Untuk meload view tertentu.
 */
if(!function_exists('section'))
{
    function section($__nav)
    {
        extract(App::view()->getVariables());
        return require "app/views/{$__nav}.view.php";
    }
}

/**
 * untuk mengarahkan ke url tertentu.
 */
if(!function_exists('redirect'))
{
    function redirect($path)
    {
        $path = makeUrl($path);
        header("location:{$path}");
    }
}

/**
 * Untuk mendapatkan url saat ini.
 */
if(!function_exists('currentUrl'))
{
    function currentUrl()
    {
        $php = $_SERVER['PHP_SELF'];
        $php = explode("index.php",$php)[0];
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode($php,$uri)[1];
        $uri = trim(
                parse_url($uri, PHP_URL_PATH), '/'
            );
        return makeUrl($uri);
    }
}

/**
 * Untuk mendapatkan url sebelumnya.
 */
if(!function_exists('previousUrl'))
{
    function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}

/**
 * untuk mengarahkan ke halaman sebelumnya.
 */
if(!function_exists('back'))
{
    function back()
    {
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
}

/**
 * Untuk meload kosmetik page atau gambar.
 */
if(!function_exists('asset'))
{
    function asset($asset)
    {
        return makeUrl('public/'.$asset);
    }
}

/**
 * Untuk melakukan enkripsi bcrypt dengan salt.
 */
if(!function_exists('bcrypt'))
{
    function bcrypt($text)
    {
        return password_hash($text,PASSWORD_BCRYPT);
    }
}

/**
 * Allias untuk App::get('auth').
 */
if(!function_exists('auth'))
{
    function auth()
    {
        return App::get('auth');
    }
}

/**
 * untuk mendapatkan path view tertentu.
 */
if(!function_exists('view_path'))
{
    function view_path($file)
    {
        return "app/views/{$file}.view.php";
    }
}

/**
 * Allias untuk App::config().
 */
if(!function_exists('config'))
{
    function config($name)
    {
        return App::get('config')[$name];
    }
}

/**
 * untuk menjalankan script php yang telah di definisi.
 */
if(!function_exists('script'))
{
    function script()
    {
        return JavaScript::getScript();
    }
}

/**
 * Alias dari DB
 */
if(!function_exists('db'))
{
    function db()
    {
        return App::database();
    }
}

if(!function_exists('session'))
{
    function session($key)
    {
        return Session::get($key)['value'];
    }
}

if(!function_exists('showError'))
{
    function showError($key)
    {
        if(isset(session('error')[$key]))
        {
            return "<p class='help-block'>".session('error')[$key]."</p>";
        }
        return '';
    }
}
