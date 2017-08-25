<?php

namespace App\Controllers;

use App\Model\User;
use Core\App;
use Core\Controller;
use Core\Validator\Validator;

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
        return view('content.login');
    }

    public function login()
    {
        $validate = [
            "username" => "required",
            "password" => "required"
        ];
        if(Validator::instance()->validate($validator,request())) { return back(); }

        $username = request()->body['username'];
        $password = request()->body['password'];

        $user = new User;
        $user->checkLogin($username,$password);
    }

    public function logOut()
    {
        $user = new User;
        $user->logout();
    }
}
