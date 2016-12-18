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
        return NULL;
    }

    /**
     * 週の最後を返す
     */
    function lastDateOfWeek() {
        return NULL;
    }

    static function weekOfDate($date) {
        return new Week(2016, 51);
    }
}