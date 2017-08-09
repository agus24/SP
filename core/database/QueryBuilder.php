<?php
/**
 * Micro Framework - It's a PHP framework for Full Stack Web Developer
 *
 * @package     Micro Framework
 * @copyright   2017 (c) Gustiawan Ouwawi
 * @author      Gustiawan Ouwawi <agusx244@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
namespace Core\Database;

/**
 * Query Builder
 *
 * @package  Micro Framework
 * @author  Gustiawan Ouwawi <agusx244@gmail.com>
 *
 */

class QueryBuilder
{
    protected $pdo;
    private $condition = '';
    private $statement = '';
    private $groupby = '';
    private $orderby = '';
    private $table = '';
    private $join = '';
    private $fetchMode;

    /**
     * konstruknya dpt dari connection class
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->fetchMode = \PDO::FETCH_CLASS;
    }

    public function get()
    {
        $state = $this->wrapQuery();
        $state = $this->pdo->prepare($state);

        try {
            $state->execute();
        } catch (Exception $e) {
            die($e->message());
        }

        return $state->fetchAll($this->fetchMode);
    }

    public function select($field = '*')
    {
        $this->statement = "SELECT {$field} FROM {$this->table}";
        return $this;
    }

    public function count($field = null)
    {
        $data = $this->get();
        return count($data);
    }

    public function insert($parameters)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $this->pdo;
        } catch (Exception $e) {
            die($e->message());
        }
    }

    public function update($parameters)
    {
        $this->statement = sprintf(
                        "UPDATE %s set %s",
                        $this->table,
                        implode(', ', array_map(function($value) {
                            return $value = $value."=:".$value;
                        }, array_keys($parameters)))
                    );
        $sql = $this->wrapQuery();
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $this->pdo;
        } catch (Exception $e) {
            die($e->message());
        }
    }

    public function delete()
    {
        $this->statement = sprintf("DELETE FROM %s",$this->table);
        $sql = $this->wrapQuery();
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $this->pdo;
        } catch (Exception $e) {
            die($e->message());
        }
    }

    public function where($field,$condition,$value)
    {
        if($this->condition == '')
        {
            $this->condition = "{$field}{$condition}'{$value}'";
        }
        else
        {
            $this->condition .= " AND {$field}{$condition}'{$value}'";
        }
        return $this;
    }

    public function orwhere($field,$condition,$value)
    {
        if($this->condition != '')
        {
            $this->condition .= " OR {$field}{$condition}'{$value}'";
        }
        return $this;
    }

    public function groupby($field)
    {
        if($this->groupby == '')
        {
            $this->groupby = "$field";
        }
        else
        {
            $this->groupby .= ", $field";
        }

        return $this;
    }

    public function orderby($field,$state = 'ASC')
    {
        if($this->orderby == '')
        {
            $this->orderby = "{$field} {$state}";
        }
        else
        {
            $this->orderby .= ", {$field} {$state}";
        }

        return $this;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function join($table,$field,$condition,$field2)
    {
        $this->join .= " INNER JOIN {$table} on {$field}{$condition}{$field2}";
        return $this;
    }

    public function leftJoin($table,$field,$condition,$field2)
    {
        $this->join .= " LEFT JOIN {$table} on {$field}{$condition}{$field2}";
        return $this;
    }

    public function rightJoin($table,$field,$condition,$field2)
    {
        $this->join .= " RIGHT JOIN {$table} on {$field}{$condition}{$field2}";
        return $this;
    }

    public function toQuery()
    {
        return $this->wrapQuery();
    }

    public function first()
    {
        return $this->get()[0];
    }

    private function wrapQuery()
    {
        if($this->statement == '')
        {
            $wrap = "SELECT * FROM {$this->table} {$this->join}";
        }
        else
        {
            $wrap = $this->statement;
        }

        if($this->condition != '')
        {
            $wrap .= " WHERE ".$this->condition;
        }

        if($this->groupby != '')
        {
            $wrap .= " GROUP BY ".$this->groupby;
        }

        if($this->orderby != '')
        {
            $this->orderby = " ORDER BY ".$this->orderby;
        }
        return $wrap;
    }
}
