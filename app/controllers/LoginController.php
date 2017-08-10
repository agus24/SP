<?php

namespace App\Controllers;

use App\Model\User;
use Core\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        if(!auth()->guest())
        {
            redirect('user');
        }
    }

    public function index()
    {
        return view('login');
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
