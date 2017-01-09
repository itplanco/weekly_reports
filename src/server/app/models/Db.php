<?php

class Db {
    private $db;
    
    static function getInstance() {
        return new Db("weekly_reports.sqlite3");
    }
    
    static function getInstance2() {
        return new Db("authorization.sqlite3");
    }
    
    function __construct($filename) {
        $this->db = new PDO("sqlite:" . __DIR__ . '/../../db/' . $filename);
    }
    
    function getArrayResult($sql, ...$param) {
        $statement = $this->prepare($sql, $param);
        $statement->execute();
        $result = [];
        while($data = $statement->fetch(PDO::FETCH_OBJ)) {
            $result[] = $data;
        }
        return $result;
    }
    
    function getSingleResult($sql, ...$param) {
        $statement = $this->prepare($sql, $param);
        $statement->execute();
        while($data = $statement->fetch(PDO::FETCH_OBJ)) {
            return $data;
        }
        return NULL;
    }
    
    function executeQuery($sql, ...$param) {
        return $this->prepare($sql, $param)->execute();
    }
    
    private function prepare($sql, $param) {
        $statement = $this->db->prepare($sql);
        
        if ($param) {
            $index = 1;
            foreach ($param as $value) {
                $statement->bindValue($index, $value);
                $index++;
            }
        }
        return $statement;
    }
}