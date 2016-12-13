<?php

class UsersService {
    
    private $db;
    
    function __construct() {
        $this->db = Db::getInstance();
    }
    
    function nextId() {
        return uniqid();
    }
    
    function findAll() {
        $users = $this->db->getArrayResult("SELECT * FROM users");
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
        // ユーザーIDを退避
        $id = $data['user_id'];

        // パスワードを退避
        $password = $data['password'];
        unset($data['password']);
        
        // DBに登録
        $result = $this->db->executeQuery("INSERT INTO users (user_id, name, password, json) values (?, ?, ?, ?)", $id, $data['name'], $password, json_encode($data));
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