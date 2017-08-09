<?php

namespace Core;

class Auth
{
    private $user = [];
    private $login = false;

    /**
     * define the user from session
     */
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

    /**
     * buat ambil class lewat static
     * @return classObj
     */
    public static function instance()
    {
        return new static;
    }

    /**
     * bwt ambil data user yg login
     * @return Model user
     */
    public function user()
    {
        return $this->user['value'];
    }

    /**
     * bwt paksa login
     * @param  classObj $user
     * @return classObj       Auth
     */
    public function login($user)
    {
        Session::set('user',$user);
        $this->user = $user;
        $this->login = true;
        return $this;
    }

    /**
     * ngecek ini yg pake uda login ato belom
     * @return bool
     */
    public function guest()
    {
        return !$this->login;
    }

    public function routeAlias()
    {
        //
    }

    /**
     * bwt paksa logout
     */
    public function logout()
    {
        $this->login = false;
        $this->user = [];
        Session::flush('user');
    }
}
