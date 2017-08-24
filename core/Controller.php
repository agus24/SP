<?php
/**
 * Controller - Base Controller untuk framework.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

namespace Core;

use Core\App;

class Controller
{
    /**
     * Melakukan pengecekan terhadap user
     * @return view cuma kalo error
     */
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

    /**
     * Melakukan mapping terhadap request
     * @param  string $key
     * @return any
     */
    protected function request($key)
    {
        return request()->body[$key];
    }
}
