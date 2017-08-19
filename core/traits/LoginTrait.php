<?php

namespace Core\Traits;

use Core\App;

trait LoginTrait
{
    public function checkLogin($username,$password)
    {
        $data = $this->db->select()->where($this->username(),'=',$username)->get();
        if(count($data) > 0)
        {
            $user = $data[0];
            if(password_verify($password,$user->password))
            {
                auth()->login($user);
                return redirect(App::config('auth')['redirect']['afterLogin']);
            }
        }
        return back();
    }

    public function logout()
    {
        auth()->logout();
        return redirect(App::config('auth')['redirect']['afterLogout']);
    }

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
