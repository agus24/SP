<?php

namespace Core\Database;

class Connection
{
    /**
     * Untuk mendefinisikan koneksi
     * @param  array $config
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
