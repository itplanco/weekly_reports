<?php

class Comment {
    public $user_id;
    public $message;
    public $post_date_time;

    static function parse($data) {
        $data = (object) $data;
        $comment = new Comment();

        if (isset($data->user_id)) {
            $comment->user_id = $data->user_id;
        }
        if (isset($data->message)) {
            $comment->message = $data->message;
        }
        if (isset($data->post_date_time)) {
            $comment->post_date_time = $data->post_date_time;
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
    public $publish_date_time;
    public $publish_comment;

    function addData($key, $value) {
        $this->data[$key] = $value;
    }

    function addComment($user_id, $message) {
        $comment = new Comment();
        $comment->user_id = $userId;
        $comment->message = $message;
        $comment->post_date_time = new DateTime();
        $this->comments[] = $comment;
    }

    function publish($publish_comment) {
        $this->publish_date_time = new DateTime();
        $this->publish_comment = $publish_comment;
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