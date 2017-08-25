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
        return view()->make('content','user')->share("users",$users)->render();
    }

    public function edit($id)
    {
        $user = User::instance()->find($id)->get()[0];
        return view()->make('content','userEdit')->share('user',$user)->render();
    }

    public function insert()
    {
        User::instance()->create([
            "name" => $this->request('name'),
            "username" => $this->request('username'),
            "password" => bcrypt($this->request('password'))
        ]);

        return back();
    }
}
