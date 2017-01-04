<?php

use PHPUnit\Framework\TestCase;

class WeekTest extends TestCase {
    function testWeekFirstDateAndLastDate() {
        $week = new Week(2017, 1);
        $expected = new DateTime('2017-01-02T00:00:00', new DateTimeZone("UTC"));
        $actual = $week->firstDateOfWeek();
        $this->assertEquals($expected, $actual);

        $expected = new DateTime('2017-01-08T00:00:00', new DateTimeZone("UTC"));
        $actual = $week->lastDateOfWeek();
        $this->assertEquals($expected, $actual);
    }

    function testWeekForSpecificDate() {
        $target = new DateTime('2017-01-02T00:00:00', new DateTimeZone("UTC"));
        $expected = new Week(2017, 1);
        $actual = Week::weekOfDate($target);
        $this->assertEquals($expected, $actual);

        $target = new DateTime('2017-01-08T00:00:00', new DateTimeZone("UTC"));
        $actual = Week::weekOfDate($target);
        $this->assertEquals($expected, $actual);
    }
}