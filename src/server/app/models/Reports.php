<?php

class Comment extends Model
{
    public $user_id;
    public $message;
    public $post_date_time;
}

class Report extends Model
{
    public $year;
    public $weeknum;
    public $user_id;
    public $data = [];
    public $comments = [];
    public $publish_date_time;
    public $publish_comment;

    function addData($key, $value) 
    {
        $this->data[$key] = $value;
    }

    function addComment($user_id, $message) 
    {
        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->message = $message;
        $comment->post_date_time = $this->stampDateTime();
        $this->comments[] = $comment;
    }

    function stampDateTime()
    {
        return new Datetime();
    }

    function publish($publish_comment)
    {
        $this->publish_date_time = $this->stampDateTime();
        $this->publish_comment = $publish_comment;
    }
}

class ReportsRepository
{

    private $db;

    function __construct($db) 
    {
        $this->db = $db;
    }

    public function findById($year, $weeknum, $user_id)
    {
        $items = $this->findItemsById($year, $weeknum, $user_id);
        if ($items) {
            $aReport = new Report();
            $aReport->year    = $year;
            $aReport->weeknum = $weeknum;
            $aReport->user_id = $user_id;
            foreach($items as $aItem)
                $aReport->addData($aItem->item_name, $aItem->content);
        } else {
            return null;
        }

        $aPublication = $this->findPublicationById($year, $weeknum, $user_id);
        if ($aPublication) {
            $aReport->publish_comment   = $aPublication->publish_comment;
            $aReport->publish_date_time = new Datetime($aPublication->publish_date_time);
        }

        $comments = $this->findCommentsById($year, $weeknum, $user_id);
        foreach($comments as $source) {
            $aComment = new Comment();
            $aComment->message = $source->message;
            $aComment->post_date_time = new Datetime($source->post_date_time);
            $aComment->user_id = $source->sender_user_id;
            $aReport->comments[] = $aComment;
        }

        return $aReport;
    }

    function findItemById($year, $weeknum, $user_id, $item_name)
    {
        return $this->db->getSingleResult("SELECT * FROM weekly_report_items WHERE year = ? AND weeknum = ? AND user_id = ? AND item_name = ?"
                                         , $year, $weeknum, $user_id, $item_name);
    }

    private function findItemsById($year, $weeknum, $user_id)
    {
        return $this->db->getArrayResult('SELECT * FROM weekly_report_items '
                                          . 'WHERE year    = ? '
                                          . 'AND   weeknum = ? '
                                          . 'AND   user_id = ? '
                                         , $year, $weeknum, $user_id);
    }

    private function findPublicationById($year, $weeknum, $user_id)
    {
        return $this->db->getSingleResult('SELECT * FROM weekly_reports '
                                          . 'WHERE year    = ? '
                                          . 'AND   weeknum = ? '
                                          . 'AND   user_id = ? '
                                         , $year, $weeknum, $user_id);
    }

    private function findCommentsById($year, $weeknum, $user_id)
    {
        return $this->db->getArrayResult('SELECT * FROM weekly_report_comments '
                                         . 'WHERE year    = ? '
                                         . 'AND   weeknum = ? '
                                         . 'AND   user_id = ? '
                                         . 'ORDER BY "index" ASC '
                                        , $year, $weeknum, $user_id);
    }

    function save($report)
    {
        $result = $this->db->executeQuery("INSERT INTO weekly_reports (year, weeknum, user_id, publish_date_time, publish_comment) values (?, ?, ?, ?, ?)"
                                         , $report->year, $report->weeknum, $report->user_id, $report->publish_date_time->format('Y-m-d H:i:s'), $report->publish_comment);
        return $result;
    }

    private function publish($report) 
    {
        $result = $this->db->executeQuery("INSERT INTO weekly_reports (year, weeknum, user_id, publish_date_time, publish_comment) values (?, ?, ?, ?, ?)"
                                         , $report->year, $report->week, $report->user_id, $report->publish_date_time, $report->publish_comment);
    }

    function reportsForWeek($year, $weekNum) 
    {
    }

    function latestReportsByUser($userId, $key, $fetchCount, $page) 
    {
    }

}
