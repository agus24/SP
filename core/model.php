<?php

namespace Core;

use Core\App;

class Model
{
    public $lastID = NULL;
    protected $db;
    protected $primaryKey = 'id';

    /**
     * define table di pdo
     */
    public function __construct()
    {
        $this->db = App::database()->table($this->table);
    }

    /**
     * bwt panggil ini class lewat static
     * @return classObj
     */
    public static function instance()
    {
        return new static;
    }

    /**
     * ambil semua data dari table
     * @return classObj (return dari pdo FETCH_OBJ)
     */
    public function all()
    {
        return $this->db->select()->get();
    }

    /**
     * bwt cari data lewat primaryKey
     * @param  any $id biasanya integer. tp sapa tau primaryKeynya bkn integer
     * @return QueryBuilder
     */
    public function find($id)
    {
        return $this->db->where($this->primaryKey,'=',$id);
    }

    /**
     * bwt create tanpa repot di model
     * @param  array $param (arraynya hrs punya key sbg nama field dan value untuk isinya)
     * @return Model
     */
    public function create($param)
    {
        $compiled = $this->db->insert($param);
        $this->lastID = $compiled->lastInsertId();
        return $this;
    }

    /**
     * bwt update tanpa repot di Model
     * @param  array $param (arraynya hrs punya key sbg nama field dan value untuk isinya)
     * @param  any $id    biasanya integer
     */
    public function update($param,$id)
    {
        $this->db->where($this->primaryKey,'=',$id)->update($param);
    }

    /**
     * bwt apus field sesuai primarykey
     * @param  any $id biasanya integer
     */
    public function delete($id)
    {
        $this->db->where($this->primaryKey,'=',$id)->delete();
    }

    /**
     * bwt join ke table2
     * @param  string $table2 nama table yg mw di join
     * @param  string $field  field di table1 yg mw di cocokin
     * @param  string $cond   (=, >, <, >=, <=, <>, LIKE)
     * @param  string $field2 field di table2 yg mw di cocokin
     * @return QueryBuilder
     */
    public function join($table2,$field,$cond,$field2)
    {
        return $this->db->join($table2,$field,$cond,$field2);
    }
}
