<?php

class Db {
    private $db;
    
    static function getInstance() {
        return new Db();
    }
    
    function __construct() {
        $this->db = new PDO("sqlite:" . __DIR__ . '/../../db/weekly_reports.sqlite3');
    }
    
    function getArrayResult($sql, ...$param) {
        $sql_result = $this->executePreparedStatement($sql, $param);
        $result = [];
        while($data = $sql_result->fetch(PDO::FETCH_OBJ)) {
            $result[] = $data;
        }
        return $result;
    }
    
    function getSingleResult($sql, ...$param) {
        $sql_result = $this->executePreparedStatement($sql, $param);
        while($data = $sql_result->fetch(PDO::FETCH_OBJ)) {
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
        $statement->execute();
        return $statement;
    }
}