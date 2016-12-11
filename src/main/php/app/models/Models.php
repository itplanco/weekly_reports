<?php

class Db {
    private $db;
    
    static function getInstance() {
        return new Db();
    }
    
    function __construct() {
        $this->db = new SQLite3('../db/weekly_reports.sqlite3');
    }
    
    function __destruct() {
        $this->db->close();
    }
    
    function getArrayResult($sql, ...$param) {
        $sql_result = $this->executePreparedStatement($sql, $param);
        $result = array();
        while($data=$sql_result->fetchArray(PDO::FETCH_OBJ)) {
            $result[] = $data;
        }
        return $result;
    }
    
    function getSingleResult($sql, ...$param) {
        $sql_result = $this->executePreparedStatement($sql, $param);
        while($data=$sql_result->fetchArray()) {
            return $data;
        }
    }
    
    function executeQuery($sql, ...$param) {
        return $this->executePreparedStatement($sql, $param);
    }
    
    private function executePreparedStatement($sql, $param) {
        $statement = $this->db->prepare($sql);
        if ($param) {
            $index = 1;
            foreach ($param as $value) {
                $statement->bindValue($index, $value);
                $index++;
            }
        }
        return $statement->execute();
    }
}