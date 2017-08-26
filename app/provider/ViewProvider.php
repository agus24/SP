<?php

namespace App\Provider;

use Core\App;
use Core\Contract\Provider;

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
