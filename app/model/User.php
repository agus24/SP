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
}
