<?php

class Group {
    public $group_id;
    public $name;
}

class User {
    public $use_id;
    public $name;
    public $groups = [];
}

class UsersRepository {
    
    private $db;
    
    function __construct($db) {
        $this->db = $db;
    }

    function nextId() {
        return uniqid();
    }
    
    function findAll() {
        $users = $this->db->getArrayResult("SELECT * FROM users");
        if (!$users) {
            return [];
        }

        foreach ($users as $user) {
            $result[] = json_decode($user['json']);
        }
        return $result;
    }
    
    function findById($id) {
        $user = $this->db->getSingleResult("SELECT * FROM users WHERE user_id = ?", $id);
        return json_decode($user['json']);
    }
    
    function insert($data) {
        // DBに登録
        $result = $this->db->executeQuery("INSERT INTO users (user_id, name, json) values (?, ?, ?)", $data['user_id'], $data['name'], json_encode($data));
        if ($result === FALSE) {
            throw new Exception();
        }
    }
    
    function update($data) {
        // IDを確認
        $id = $data['user_id'];
        
        // DBに登録
        $result = $this->db->executeQuery("UPDATE users SET json = ? WHERE user_id = ?", json_encode($data), $id);
        if ($result === FALSE) {
            throw new Exception();
        }
        
        // 新規に登録したデータを返す
        return findById($id);
    }
    
    function delete($id) {
        // DBから削除
        $result = $this->db->executeQuery("DELETE users WHERE user_id = ?", $id);
        if ($result === FALSE) {
            throw new Exception();
        }
    }
}