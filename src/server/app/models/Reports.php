<?php

class Comment extends Model {
    public $user_id;
    public $message;
    public $post_date_time;
}

class Report extends Model {
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
        $report = parent::parse($data);
        $report->comments = [];
        if (isset($data->comments)) {
            foreach($data->comments as $comment) {
                $report->comments[] = Comment::parse($comment);
            }
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