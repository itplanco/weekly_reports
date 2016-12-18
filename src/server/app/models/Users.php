<?php

class User {
    public $user_id;
    public $name;
    public $groups;

    static function parse($data) {
        $data = (object) $data;
        $user = new User();

        if (isset($data->user_id)) {
            $user->user_id = $data->user_id;
        }
        if (isset($data->name)) {
            $user->name = $data->name;
        }
        if (isset($data->groups)) {
            foreach($data->groups as $group) {
                $user->groups[] = Group::parse($group);
            }
        } else {
            $user->groups = [];
        }

        return $user;
    }
}

class Group {
    public $group_id;
    public $name;

    static function parse($data) {
        $data = (object) $data;
        $group = new Group();

        if (isset($data->group_id)) {
            $group->group_id = $data->group_id;
        }
        if (isset($data->name)) {
            $group->name = $data->name;
        }
        return $group;
    }
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
        $data = $this->db->getArrayResult("SELECT * FROM users");
        if (!$data) {
            return [];
        }

        foreach ($data as $user) {
            $result[] = User::parse(json_decode($user['json'], TRUE));
        }
        return $result;
    }
    
    function findById($id) {
        $user = $this->db->getSingleResult("SELECT * FROM users WHERE user_id = ?", $id);
        return User::parse(json_decode($user['json'], TRUE));
    }
    
    function insert(User $user) {
        // モデルからID・JSONを取得
        $id = $user->user_id;
        $json = json_encode($user);

        // DBに登録
        $result = $this->db->executeQuery("INSERT INTO users (user_id, json) values (?, ?)", $id, $json);
        if ($result === FALSE) {
            throw new Exception("DBの登録に失敗しました。");
        }

        return findById($id);
    }
    
    function update(User $user) {
        // IDを確認
        $id = $user->user_id;
        $json = json_encode($user);
        
        // DBに登録
        $result = $this->db->executeQuery("UPDATE users SET json = ? WHERE user_id = ?", $json, $id);
        if ($result === FALSE) {
            throw new Exception("DBの登録に失敗しました。");
        }
        
        // 新規に登録したデータを返す
        return findById($id);
    }
    
    function delete($id) {
        // DBから削除
        $result = $this->db->executeQuery("DELETE users WHERE user_id = ?", $id);
        if ($result === FALSE) {
            throw new Exception("DBの登録に失敗しました。");
        }
    }
}