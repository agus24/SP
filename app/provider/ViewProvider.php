<?php

namespace App\Provider;

use Core\App;
use Core\Interfaces\Provider;

class ViewProvider implements Provider
{
    /**
     * running the script
     */
    public function boot()
    {
        App::view()->extend('partials/layout')
            ->make('nav','partials/nav');
    }
}
