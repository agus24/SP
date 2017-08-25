<?php

namespace Core\Traits;

use Core\App;
use Core\Session;

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
        Session::flash('error',[
            "__all" => ["Username Or Password is wrong."],
        ]);
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
}
