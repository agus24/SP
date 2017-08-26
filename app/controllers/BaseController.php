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
        return view('content.home');
    }
}
