<?php

namespace App\Controllers;

use App\Model\User;
use Core\App;
use Core\Controller;
use Core\JavaScript;
use Core\Session;
use System\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->login();
    }

    public function index()
    {
        $users = User::instance()->all();
        JavaScript::addJS(asset('js/app.js'));
        return view('user',compact('users'));
    }

    public function store()
    {
        $user = User::instance();
        $user->create([
            "name" => $this->request('name'),
            "username" => $this->request('username'),
            "password" => bcrypt($this->request('password'))
        ]);
        return redirect('user');
    }

    public function get($id)
    {
        $users = User::instance()->find($id)->first();
        dd($users);
    }

    public function edit($id)
    {
        $user = User::instance()->find($id)->first();
        return view('userEdit', compact('user'));
    }

    public function update($id)
    {
        $user = User::instance()->update([
            "name" => $this->request('name'),
            "username" => $this->request('username'),
            "password" => bcrypt($this->request('password'))
        ],$id);
        return redirect('user');
    }

    public function delete($id)
    {
        $user = User::instance()->find($id);
        $user->delete();
        return redirect('user');
    }
}
