<?php

class Comment {
    public $user_id;
    public $comment;
    public $posted;

    static function parse($data) {
        $data = (object) $data;
        $comment = new Comment();

        if (isset($data->user_id)) {
            $comment->user_id = $data->user_id;
        }
        if (isset($data->comment)) {
            $comment->comment = $data->comment;
        }
        if (isset($data->posted)) {
            $comment->posted = $data->posted;
        }
        return $comment;
    }
}

class Report {
    public $year;
    public $weeknum;
    public $user_id;
    public $data = [];
    public $comments = [];

    function addData($key, $value) {
        $data[$key] = $value;
    }

    function addComments($user_id, $message) {
        $comment = new Comment();
        $comment->user_id = $userId;
        $comment->comment = $message;
        $comment->posted = date('Y-m-d H:i:s');
        $comments[] = $comment;
    }

    static function parse($data) {
        $data = (object) $data;
        $report = new Report();

        if (isset($data->year)) {
            $report->year = $data->year;
        }
        if (isset($data->weeknum)) {
            $report->weeknum = $data->weeknum;
        }
        if (isset($data->user_id)) {
            $report->user_id = $data->user_id;
        }
        if (isset($data->data)) {
            $report->data = $data->data;
        }
        if (isset($data->comments)) {
            foreach($data->comments as $comment) {
                $report->comments[] = Comment::parse($comment);
            }
        } else {
            $report->comments = [];
        }
        return $report;
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