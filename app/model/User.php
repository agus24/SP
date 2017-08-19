<?php

namespace App\Model;

use Core\Model;
use Core\Traits\LoginTrait;

class User extends Model
{
    use LoginTrait;

    protected $table = 'user';
    protected $primaryKey = 'id';

    private function username()
    {
        return "username";
    }

    private function redirectAfterLogin()
    {
        return "user";
    }

    private function redirectAfterLogout()
    {
        return "";
    }
}
