<?php
class DB {
    private static $_instance = null; 
    private $_pdo, $_query, $_error = false, $_result, $_count = 0, $_lastInsertID = null;

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    
    //  this function makes it a singleton class.
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = []) {
        $this->_error = false;
        // prepare sql statement
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            // if query is successfull set up all variables
            if($this->_query->execute()) {
                $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                $this->lastInsertID = $this->_pdo->lastInsertId();
            } else {
                $this->_error = true;
            }

        }

        return $this;
    
    }

    protected function _read($table, $params = []) {
        $conditionString = '';
        $bind = [];
        $order = '';
        $limit = '';
        // conditions
        if (isset($params['conditions'])) {
            if(is_array($params['conditions'])) {
                foreach($params['conditions'] as $condition) {
                    $conditionString .= ' ' . $condition . ' AND';
                }
                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString, ' AND');
            } else {
                $conditionString = $params['conditions'];
            }

            if ($conditionString != '') {
                $conditionString = ' WHERE ' . $conditionString;
            }
        }
        // bind
        if (array_key_exists('bind', $params)) {
            $bind = $params['bind'];
        }
        // order
        if (array_key_exists('order', $params)) {
            $order = ' ORDER BY ' . $params['order'];
        }
        // limit
        if (array_key_exists('limit', $params)) {
            $limit = ' LIMIT '. $params['limit'];
        }
        $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
        
        if ($this->query($sql, $bind)) {
            if (!count($this->_result)) return false;
            return true;
        }
        return false;
    }

    public function find($table, $params = []) {
        if($this->_read($table, $params)) {
            return $this->results();
        }
        return false;

    }
    public function findFirst($table, $params = []) {
        if ($this->_read($table, $params)) {
            return $this->first();
        }
        return false;
    }

    /**
     * This function inserts the given array into the given table and executes it.
     * $table = table to insert into
     * 
     * $fields = an associative array of the table colums and values like:
     * 
     * 'column name' => 'column value'
     * 
     * @var $table = table to insert into
     * @var $fields is an associative array of the table colums and values
     */

    public function insert($table, $fields = []) {
        $fieldString = '';
        $valueString = '';
        $values = [];
        foreach($fields as $field => $value) {
            $fieldString .= $field . ', ';
            $valueString .= '?,';
            $values[] = $value;
        }
        $valueString = rtrim($valueString, ',');
        $fieldString = rtrim($fieldString, ', ');
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
        if(!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }

/**
 * Updates the given table and set it's fields where id = the given id.
 * Protects against sql injection
 *  
 * @param string $table
 * @param integer $id
 * @param array $fields
 * @return void
 */
    public function update($table, $id, $fields = []) {
        $fieldString = '';
        $values = [];
        foreach($fields as $field => $value) {
            $fieldString .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString); // remove the white space in front of the string
        $fieldString = rtrim($fieldString, ',');
        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
        if(!$this->query($sql, $values)->error()) {
            return true;
        }

        return false;

    }

    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";
        if (!$this->query($sql)->error()) {
            return true;
        }
        return false;

    }

    public function results() {
        return $this->_result;
    }

    public function first() {
        return (!empty($this->_result)) ? $this->_result[0] : [];
    }

    public function count() {
        return $this->_count;
    }

    public function lastID() {
        return $this->_lastInsertID;
    }
    public function get_columns($table) {
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    }

    public function error() {
        return $this->_error;
    }

}