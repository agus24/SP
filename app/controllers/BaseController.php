<?php

namespace App\Controllers;

use App\Model\User;
use Core\Controller;
use Core\View\View;

class BaseController extends Controller
{
    public function index()
    {
        $users = User::instance()->all();
        return view()->extend('partials/layout')
                    ->make('nav','partials/nav')
                    ->make('content','user')
                    ->share("users",$users)
                    ->render();
    }

    public function edit($id)
    {
        $user = User::instance()->find($id)->get()[0];
        return view()
                    ->make('content','userEdit')
                    ->share('user',$user)
                    ->render();
    }
}
