<?php

class WeeklyReportsApiController extends Controller {
    private $repository;
    
    function __construct($repository = NULL) {
        if ($repository) {
            $this->repository = $repository;
        } else {
            $this->repository = new ReportSummariesRepository(Db::getInstance());
        }
    }

    /**
     * 今日の日付で一覧を取得する
     */
    function index() {
        $week = Week::weekForToday();
        return get($week->year, $week->weeknum);
    }

    /**
     * 指定した年、週番号で一覧を取得する
     */
    function get($year, $weeknum) {
        $result = $this->repository->selectSummariesForWeek($year, $weeknum);
        return $this->ok($result);
    }
}