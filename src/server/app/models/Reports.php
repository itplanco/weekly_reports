<?php

class Report {
    public $year;
    public $weeknum;
    public $user_id;
    public $data = [];
    public $comments = [];

    function addData($key, $value) {
        $data[$key] = $value;
    }

    function addComments($userId, $comment) {
        $comments[] = [
            "user_id" => $userId,
            "comment" => $comment
        ];
    }
}

class ReportsRepository {
    
    private $db;
    
    function __construct($db) {
        $this->db = $db;
    }
    
    function save($report) {
    }
    
    function reportsForWeek($year, $weekNum) {
    }

    function latestReportsByUser($userId, $key, $fetchCount, $page) {
    }

}