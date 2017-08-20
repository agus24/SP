<?php

use Core\App;
use Core\JavaScript;
use Core\View\View;
use System\Request;

if(!function_exists('dd'))
{
    function dd($var)
    {
        die(var_dump($var));
    }
}

if(!function_exists('request'))
{
    function request()
    {
        return $request = Request::instance();
    }
}

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

if(!function_exists('view'))
{
    function view($file,$variables = [])
    {
        return View::make($file)->share($variables)->render();
        extract($variables);
        return require "app/views/{$file}.view.php";
    }
}

if(!function_exists('redirect'))
{
    function redirect($path)
    {
        $path = makeUrl($path);
        header("location:{$path}");
    }
}

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
if(!function_exists('previousUrl'))
{
    function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}

if(!function_exists('back'))
{
    function back()
    {
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
}

if(!function_exists('asset'))
{
    function asset($asset)
    {
        return makeUrl('public/'.$asset);
    }
}

if(!function_exists('bcrypt'))
{
    function bcrypt($text)
    {
        return password_hash($text,PASSWORD_BCRYPT);
    }
}

if(!function_exists('auth'))
{
    function auth()
    {
        return App::get('auth');
    }
}

if(!function_exists('view_path'))
{
    function view_path($file)
    {
        return "app/views/{$file}.view.php";
    }
}

if(!function_exists('config'))
{
    function config($name)
    {
        return App::get('config')[$name];
    }
}

if(!function_exists('script'))
{
    function script()
    {
        return JavaScript::getScript();
    }
}
