<?php

namespace Core\Database;

class Connection
{
    /**
     * gw buat pisah biar bisa pake 2 koneksi ato lebih nantinya
     * @param  array $config config dari file config.php
     * @return PDO
     */
    public static function make($config)
    {
        try {
            return new \PDO(
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die(trigger_error($e->getMessage()));
        }
    }
}
