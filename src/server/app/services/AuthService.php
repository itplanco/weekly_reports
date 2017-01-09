<?php

class AuthService {
    
    private $db;
    
    function __construct($db = NULL) {
        $this->db = DB::getInstance2();
    }

    function login($username, $password) {
        $result = $this->db->getSingleResult("SELECT COUNT(1) cnt FROM login_users WHERE username = ? AND password = ?", $username, $password);
        if ($result->cnt > 0) {
            return (object) [
                "success" => TRUE
            ];
        } else {
            return (object) [
                "success" => FALSE
            ];
        }
    }

    function authorize($route) {
        return true;
    }
}