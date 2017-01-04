<?php

class Group extends Model {
    public $group_id;
    public $name;
}

class User extends Model {
    public $user_id;
    public $name;
    public $groups;

    static function parse($data) {
        $data = (object) $data;
        $user = parent::parse($data);
        $user->groups = [];
        if (isset($data->groups)) {
            foreach($data->groups as $group) {
                $user->groups[] = Group::parse($group);
            }
        }
        return $user;
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
            $result[] = User::parse(json_decode($user->json, TRUE));
        }
        return $result;
    }
    
    function findById($id) {
        $user = $this->db->getSingleResult("SELECT * FROM users WHERE user_id = ?", $id);
        if ($user) {
            return User::parse(json_decode($user->json, TRUE));
        }
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

        return $this->findById($id);
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
        
        // 更新したデータを返す
        return $this->findById($id);
    }
    
    function delete($id) {
        // DBから削除
        $result = $this->db->executeQuery("DELETE FROM users WHERE user_id = ?", $id);
        if ($result === FALSE) {
            throw new Exception("DBの登録に失敗しました。");
        }
    }
}