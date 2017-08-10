<?php

use Core\App;
use Core\JavaScript;
use System\Request;

function dd($var)
{
    die(var_dump($var));
}

function request()
{
    return $request = Request::instance();
}

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

function view($file,$variables = [])
{
    extract($variables);
    return require "app/views/{$file}.view.php";
}

function redirect($path)
{
    $path = makeUrl($path);
    header("location:{$path}");
}

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

function previousUrl()
{
    return $_SERVER['HTTP_REFERER'];
}

function back()
{
    header('location:'.$_SERVER['HTTP_REFERER']);
}

function asset($asset)
{
    return makeUrl('public/'.$asset);
}

function bcrypt($text)
{
    return password_hash($text,PASSWORD_BCRYPT);
}

function auth()
{
    return App::get('auth');
}

function view_path($file)
{
    return "app/views/{$file}.view.php";
}

function config($name)
{
    return App::get('config')[$name];
}

function script()
{
    return JavaScript::getScript();
}
