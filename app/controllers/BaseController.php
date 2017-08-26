<?php

namespace App\Controllers;

use App\Model\User;
use Core\Controller;
use Core\Validator\Validator;
use Core\View\View;

class BaseController extends Controller
{
    public function index()
    {
        $users = User::instance()->all();
        return view('content.user', compact('users'));
    }
}
