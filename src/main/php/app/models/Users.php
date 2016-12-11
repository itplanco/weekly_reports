<?php

class UsersService {
    
    private $db;
    
    function __construct() {
        $this->db = Db::getInstance();
    }
    
    function nextId() {
        $user = $this->db->getSingleResult("SELECT MAX(user_id) user_id FROM users");
        return $user['user_id'];
    }
    
    function findAll() {
        return $this->db->getArrayResult("SELECT * FROM users");
    }
    
    function findById($id) {
        return $this->db->getSingleResult("SELECT * FROM users WHERE user_id = ?", $id);
    }
    
    function insert($data) {
        // パスワードを退避
        $password = $data['password'];
        unset($data['password']);
        
        // 新規IDを採番
        $id = $this->nextId();
        $data['user_id'] = $id;
        
        // DBに登録
        $result = $this->db->executeQuery("INSERT INTO users (user_id, password, json) values (?, ?, ?)", $id, $password, json_encode($data));
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
}