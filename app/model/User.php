<?php

namespace App\Model;

use Core\Model;
use Core\Traits\LoginTrait;

class User extends Model
{
    /**
     * Untuk membuat model ini untuk basic login
     */
    use LoginTrait;

    /**
     * Nama table dari model
     * @var string
     */
    protected $table = 'user';

    /**
     * Primary Key table
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Set true untuk mencatat waktu input dan update dari record.
     * @var boolean
     */
    protected $timeStamp = false;

    /**
     * Untuk field username yang akan dipakai untuk login
     * @return [type] [description]
     */
    private function username()
    {
        return "username";
    }
}
