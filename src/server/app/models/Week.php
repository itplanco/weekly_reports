<?php

/**
 * ISO8601週番号を取得する
 * 週は月曜日始まり、1年の最初の週は第1回目の木曜日が含まれる週
 */
class Week {
    private $year;
    private $weeknum;

    function __construct($year, $weeknum) {
        $this->year = $year;
        $this->weeknum = $weeknum;
    }

    /**
     * 週の最初を返す
     */
    function firstDateOfWeek() {
        $week_start = new DateTime('2000-01-01T00:00:00', new DateTimeZone("UTC"));
        $week_start->setISODate($this->year, $this->weeknum);
        return $week_start;
    }

    /**
     * 週の最後を返す
     */
    function lastDateOfWeek() {
        $week_end = new DateTime('2000-01-01T00:00:00', new DateTimeZone("UTC"));
        $week_end->setISODate($this->year, $this->weeknum, 7);
        return $week_end;
    }

    /**
     * 特定日の週オブジェクトを取得する
     */
    static function weekOfDate($date) {
        return new Week((int) $date->format("Y"), (int) $date->format("W"));
    }

    /**
     * 今日の週オブジェクトを取得する
     */
    static function weekForToday() {
        return weekOfDate(new DateTime());
    }
}