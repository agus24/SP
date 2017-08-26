<?php

namespace App\Controllers;

use App\Model\User;
use Core\App;
use Core\Controller;
use Core\Validator\Validator;

class LoginController extends Controller
{
    /**
     * Jika user sudah login maka akan diarahkan ke halaman berikutnya.
     */
    public function __construct()
    {
        if(!auth()->guest())
        {
            redirect(App::config('auth')['redirect']['afterLogin']);
        }
    }

    /**
     * untuk memanggil view yang akan digunakan untuk user login
     */
    public function index()
    {
        return view('content.login');
    }

    /**
     * untuk melakukan proses login
     */
    public function login()
    {
        $validate = [
            "username" => "required",
            "password" => "required"
        ];

        if(Validator::instance()->validate($validate,request())) { return back(); }

        $username = request()->body['username'];
        $password = request()->body['password'];

        $user = new User;
        $user->checkLogin($username,$password);
    }

    /**
     * Untuk Melakukan logout
     */
    public function logOut()
    {
        $user = new User;
        $user->logout();
    }
}
