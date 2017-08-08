<?php

namespace Core;

class Auth
{
    private $user = [];
    private $login = false;

    public function __construct($user)
    {
        if($user == null)
        {
            $user = [];
            $this->login = false;
        }
        else
        {
            $this->user = $user;
            $this->login = true;
        }
    }

    public function user()
    {
        return $this->user;
    }

    public function login($user)
    {
        $_SESSION['user'] = $user;
        $this->user = $user;
        $this->login = true;
        return $this;
    }

    public function guest()
    {
        return !$this->login;
    }

    public function logout()
    {
        $this->login = false;
        $this->user = [];
        session_destroy();
    }
}
