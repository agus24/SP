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
        view()->use('partials/layout')
            ->make('nav','partials/nav');
    }
}
