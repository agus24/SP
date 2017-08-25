<?php

namespace App\Model;

use Core\Model;
use Core\Traits\LoginTrait;

class User extends Model
{
    use LoginTrait;

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $timeStamp = true;
}
