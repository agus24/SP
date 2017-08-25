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
        return view('content.user', compact('users'));
    }

    public function edit($id)
    {
        $user = User::instance()->find($id)->get()[0];
        return view('content.userEdit',compact('user'));
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

    public function delete($id)
    {
        User::instance()->delete($id);
        return back();
    }
}
