<?php

namespace App\Controllers;

use App\Model\User;
use Core\App;
use Core\Controller;
use Core\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->login();
    }

    public function index()
    {
        $users = (new User)->all();
        return view('user',compact('users'));
    }

    public function store()
    {
        $user = new User;
        $user->inputUser([
            "name" => $_POST['name'],
            "username" => $_POST['username'],
            "password" => $_POST['password']
        ]);
        return redirect('user');
    }

    public function get($id)
    {
        $users = (new User)->find($id)->first();
        dd($users);
    }

    public function edit($id)
    {
        $user = new User;
        $user = $user->find($id)->first();
        return view('userEdit', compact('user'));
    }

    public function update($id)
    {
        $user = (new User)->find($id);
        $user->updUser([
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "password" => $_POST['password']
        ]);
        return redirect('user');
    }

    public function delete($id)
    {
        $user = (new User)->find($id);
        $user->delete();
        return redirect('user');
    }
}
