<?php

namespace Core;

use Core\App;

class Model
{
    public $lastID = NULL;
    protected $db;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->db = App::database()->table($this->table);
        return $this;
    }

    public static function instance()
    {
        return new static;
    }

    public function all()
    {
        return $this->db->select()->get();
    }

    public function find($id)
    {
        return $this->db->where($this->primaryKey,'=',$id);
    }

    public function create($param)
    {
        $compiled = $this->db->insert($param);
        $this->lastID = $compiled->lastInsertId();
        return $this;
    }

    public function update($param,$id)
    {
        $this->db->where($this->primaryKey,'=',$id)->update($param);
    }

    public function delete($id)
    {
        $this->db->where($this->primaryKey,'=',$id)->delete();
    }

    public function join($table2,$field,$cond,$field2)
    {
        return $this->db->join($table2,$field,$cond,$field2);
    }
}
