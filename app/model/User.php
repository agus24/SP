<?php

namespace App\Model;

use Core\Model;
use Core\Traits\ModelTrait as Mtrait;
use Core\Traits\LoginTrait;

class User extends Model
{
    use LoginTrait;
    protected $table = 'user';
    protected $primaryKey = 'id';

    public function inputUser($param)
    {
        if(array_key_exists('password', $param))
        {
            $param['password'] = bcrypt($param['password']);
        }
        $compiled = $this->create($param);
        return $compiled;
    }

    public function updUser($param,$id)
    {
        if(array_key_exists('password', $param))
        {
            $param['password'] = bcrypt($param['password']);
        }

        $this->update($param,$id);
    }
}
