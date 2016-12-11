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
    
    function getArrayResult($sql, $param) {
        $sql_result = $this->executePreparedStatement($sql, $param);
        $result=array();
        while($data=$sql_result->fetchArray()) {
            $result[] = json_decode($data["json"]);
        }
        return $result;
    }
    
    function getSingleResult($sql, $param) {
        $sql_result = $this->executePreparedStatement($sql, $param);
        while($data=$sql_result->fetchArray()) {
            return json_decode($data["json"]);
        }
    }
    
    function executeQuery($sql, $param) {
        return $this->executePreparedStatement($sql, $param);
    }
    
    private function executePreparedStatement($sql, $param) {
        $statement = $this->db->prepare($sql);
        if ($param) {
            foreach ($param as $key => $value) {
                $statement->bindValue($key, $value);
            }
        }
        return $sql_result = $statement->execute();
    }
}