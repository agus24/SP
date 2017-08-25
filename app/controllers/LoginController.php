<?php

namespace App\Controllers;

use App\Model\User;
use Core\App;
use Core\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        if(!auth()->guest())
        {
            redirect(App::config('auth')['redirect']['afterLogin']);
        }
    }

    public function index()
    {
        return view()->make('content','login')->render();
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User;
        $user->checkLogin($username,$password);
    }

    public function logOut()
    {
        $user = new User;
        $user->logout();
    }

    public function test()
    {
        echo 'a';
    }
}
