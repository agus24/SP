<?php
/**
 * SPX Framework - It's a PHP framework for Full Stack Web Developer
 *
 * @package     SPX Framework
 * @copyright   2017 (c) Gustiawan Ouwawi
 * @author      Gustiawan Ouwawi <agusx244@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Core\Database;

/**
 * Query Builder
 *
 * @package  SPX Framework
 * @author  Gustiawan Ouwawi <agusx244@gmail.com>
 *
 */

class QueryBuilder
{
    /**
     * Variabel untuk menampung class PDO
     * @var object
     */
    protected $pdo;

    /**
     * Variabel untuk where
     * @var string
     */
    private $condition = '';

    /**
     * Variabel yang menampung query yang sudah di buat.
     * @var string
     */
    private $statement = '';

    /**
     * Variabel untuk groupby
     * @var string
     */
    private $groupby = '';

    /**
     * Variabel untuk orderby
     * @var string
     */
    private $orderby = '';

    /**
     * Variabel untuk nama table
     * @var string
     */
    private $table = '';

    /**
     * Variabel untuk Join
     * @var string
     */
    private $join = '';

    /**
     * Variabel untuk opsi pada PDO
     * @var PDO Fetch
     */
    private $fetchMode;

    /**
     * konstruknya dpt dari connection class
     * @param PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->fetchMode = \PDO::FETCH_CLASS;
    }

    public function raw($statement)
    {
        $this->statement = $statement;
        return $this->get();
    }

    public function tableExist($table)
    {
        $this->statement = sprintf("SHOW TABLES LIKE '%s'",$table);
        return count($this->get()) > 0;
    }

    /**
     * bwt jalanin select
     * @return obj hasil query bentuk object/class
     */
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

    /**
     * bwt select ini
     * @param  string $field default gw set jadi * biar lgsg ambil smua field
     * @return object        self class
     */
    public function select($field = '*')
    {
        $this->statement = "SELECT {$field} FROM {$this->table}";
        return $this;
    }

    /**
     * bwt count jumlah record yg di select
     * @return integer        jumlah record
     */
    public function count()
    {
        $data = $this->get();
        return count($data);
    }

    /**
     * jalanin insert query
     * @param  array $parameters param yg mw di insert
     * @return PDO
     */
    public function insert(array $parameters)
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

    /**
     * bwt update database
     * @param  array $parameters isi field yg mw di update
     * @return PDO
     */
    public function update(array $parameters)
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

    /**
     * bwt delete database
     * @return PDO
     */
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

    /**
     * bwt isi where field
     * @param  string $field     fieldnya
     * @param  string $condition kondisinya ('=', '<', '>' dlsb)
     * @param  string $value     value
     * @return QueryBuilder
     */
    public function where($field,$condition, $value)
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

    /**
     * where bwt OR
     * @param  string $field
     * @param  string $condition
     * @param  any $value
     * @return QueryBuilder
     */
    public function orwhere($field,$condition,$value)
    {
        if($this->condition != '')
        {
            $this->condition .= " OR {$field}{$condition}'{$value}'";
        }
        return $this;
    }

    /**
     * bwt groupby field
     * @param  string $field
     * @return QueryBuilder
     */
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

    /**
     * bwt order
     * @param  string $field
     * @param  string $state tipenya
     * @return QueryBuilder
     */
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

    /**
     * bwt ngisi table
     * @param  string $table
     * @return QueryBuilder
     */
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * bwt join
     * @param  string $table
     * @param  string $field
     * @param  string $condition
     * @param  string $field2
     * @return QueryBuilder
     */
    public function join($table, $field, $condition, $field2)
    {
        $this->join .= " INNER JOIN {$table} on {$field}{$condition}{$field2}";
        return $this;
    }

    /**
     * bwt left join
     * @param  string $table
     * @param  string $field
     * @param  string $condition
     * @param  string $field2
     * @return QueryBuilder
     */
    public function leftJoin($table, $field, $condition, $field2)
    {
        $this->join .= " LEFT JOIN {$table} on {$field}{$condition}{$field2}";
        return $this;
    }

    /**
     * bwt right join
     * @param  string $table
     * @param  string $field
     * @param  string $condition
     * @param  string $field2
     * @return QueryBuilder
     */
    public function rightJoin($table, $field, $condition, $field2)
    {
        $this->join .= " RIGHT JOIN {$table} on {$field}{$condition}{$field2}";
        return $this;
    }

    /**
     * return querynya
     * @return string
     */
    public function toQuery()
    {
        return $this->wrapQuery();
    }

    /**
     * ambil data pertama
     * @return obj
     */
    public function first()
    {
        return $this->get()[0];
    }

    /**
     * bkin querynya
     * @return string
     */
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
