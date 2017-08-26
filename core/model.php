<?php
/**
 * Model - Core dari model yang akan digunakan oleh model-model yang didefiniskan.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

namespace Core;

use Core\App;
use Core\Statics\MakeStatic;

class Model
{
    /**
     * Untuk mengubah class menjadi static.
     */
    use MakeStatic;

    /**
     * Untuk menyimpan ID terakhir dari sebuah model.
     * @var null
     */
    public $lastID = NULL;

    /**
     * Variabel tempat menyimpan Database
     */
    protected $db;

    /**
     * Variabel untuk mendisable timestamp
     * @var boolean
     */
    protected $timeStamp = true;

    /**
     * Primarykey dari model.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Mendefinisikan table di PDO
     */
    public function __construct()
    {
        if(App::database()->tableExist($this->table))
        {
            $this->db = App::database()->table($this->table);
        }
        else
        {
            throw new \Exception("Table {$this->table} Not Found in Database");
        }
    }

    /**
     * Untuk mengambil semua data dari table
     * @return classObj (return dari pdo FETCH_OBJ)
     */
    public function all()
    {
        return $this->db->select()->get();
    }

    /**
     * Untuk mencari data lewat primaryKey
     * @param  any $id
     * @return QueryBuilder
     */
    public function find($id)
    {
        return $this->db->where($this->primaryKey,'=',$id);
    }

    /**
     * Untuk melakukan create data
     * @param  array $param
     * @return Model
     */
    public function create($param)
    {
        if($this->timeStamp) { $param["created_time"] = date('Y-m-d h:i:s'); }
        $compiled = $this->db->insert($param);
        $this->lastID = $compiled->lastInsertId();
        return $this;
    }

    /**
     * Untuk melakukan update data
     * @param  array $param
     * @param  any $id    biasanya integer
     */
    public function update($param,$id)
    {
        if($this->timeStamp) { $param["updated_time"] = date('Y-m-d h:i:s'); }
        $this->db->where($this->primaryKey,'=',$id)->update($param);
    }

    /**
     * Untuk melakukan delete data
     * @param  any $id biasanya integer
     */
    public function delete($id)
    {
        $this->db->where($this->primaryKey,'=',$id)->delete();
    }

    /**
     * Untuk melakukan join table
     * @param  string $table2 nama table kedua
     * @param  string $field  field di table pertama yg akan digunakan untuk kondisi
     * @param  string $cond   (=, >, <, >=, <=, <>, LIKE)
     * @param  string $field2 field di table kedua yg akan digunakan untuk kondisi
     * @return QueryBuilder
     */
    public function join($table2,$field,$cond,$field2)
    {
        return $this->db->join($table2,$field,$cond,$field2);
    }
}
