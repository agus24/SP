<?php

namespace Core;

use Core\App;

class Controller
{
    protected function login()
    {
        if(App::get('auth')->guest())
        {
            $error = App::get('config')['error'];
            if(file_exists(view_path($error['405'])))
            {
                return die(view($error['405']));
            }
            else
            {
                die('you dont have access to this page.');
            }
        }
    }

    protected function request($key)
    {
        return request()->body[$key];
    }
}
