<?php
/**
 * Auth - Untuk memanajemen authentikasi user.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

namespace Core;

use Core\Statics\MakeStatic;

class Auth
{
    /**
     * Untuk membuat class Static
     */
    use MakeStatic;

    /**
     * List Data User
     * @var array
     */
    private $user = [];

    /**
     * Flag yang menandakan login atau tidak
     * @var boolean
     */
    private $login = false;

    /**
     * Deklarasi User List
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
     * Untuk mengambil data user yg login
     * @return Model user
     */
    public function user()
    {
        return $this->user['value'];
    }

    /**
     * Untuk memaksa authentikasi user
     * @param  classObj $user
     * @return classObj       Auth
     */
    public function login($user)
    {
        Session::set('user',$user);
        Session::set('logintime',time());
        $this->user = $user;
        $this->login = true;
        return $this;
    }

    /**
     * Untuk mengecek apakah user belum login
     * @return bool
     */
    public function guest()
    {
        return !$this->login;
    }

    /**
     * Untuk melakukan logout
     */
    public function logout()
    {
        $this->login = false;
        $this->user = [];
        Session::flush('user');
    }
}
