<?php

namespace App\Provider;

use Core\Interfaces\Provider;

class ViewProvider implements Provider
{
    /**
     * running the script
     */
    public function boot()
    {
        view()->extend('partials/layout')
            ->make('nav','partials/nav');
    }
}
