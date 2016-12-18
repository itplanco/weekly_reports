<?php

class ReportSummary {
    public $year;
    public $weeknum;
    public $user;
    public $publish_date_time;
    public $publish_comment;

    static function parse($data) {
        $data = (object) $data;
        $reportSummary = new ReportSummary();

        if (isset($data->year)) {
            $reportSummary->year = $data->year;
        }
        if (isset($data->weeknum)) {
            $reportSummary->weeknum = $data->weeknum;
        }
        if (isset($data->user)) {
            $reportSummary->user = User::parse($data->user);
        }
        if (isset($data->publish_date_time)) {
            $reportSummary->publish_date_time = $data->publish_date_time;
        }
        if (isset($data->publish_comment)) {
            $reportSummary->publish_comment = $data->publish_comment;
        }
        return $reportSummary;
    }
}

class ReportSummariesRepository {
    
    private $db;
    
    function __construct($db) {
        $this->db = $db;
    }

    function selectSummariesForWeek($year, $weeknum) {
        $result = $this->db->getArrayResult("SELECT weekly_reports.*, users.json FROM weekly_reports INNER JOIN users ON week_reports.user_id = users.user_id WHERE year = ? AND weeknum = ?", $year, $weeknum);
        $reportSummaries = [];
        foreach ($result as $record) {
            $reportSummary = ReportSummary::parse((array) $record);
            $reportSummary->user = User::parse($record->json);
            $reportSummaries[] = $reportSummary;
        }
        return $reportSummaries;
    }
}