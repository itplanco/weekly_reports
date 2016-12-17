<?php

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