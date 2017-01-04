<?php

use PHPUnit\Framework\TestCase;

class ReportsTest extends TestCase {
    function testAddData1() {
        $cut = new Report();
        $expected = array('a' => 'b');
        $cut->addData(Key($expected), current($expected));
        $actual = $cut->data;
        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testAddData2() {
        $cut = new Report();
        $expected = array('A' => 1,
                          'B' => 2,
                          'C' => 3);

        foreach($expected as $key => $value)
            $cut->addData($key, $value);

        $actual = $cut->data;

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testAddComment()
    {
        $dummyTimestamp = (new DateTime())->getTimestamp();

        $stub = $this->getMockBuilder(Report::class)
                     ->setMethods(['stampDateTime'])
                     ->getMock();
        $stub->method('stampDateTime')
             ->willReturn($dummyTimestamp);

        $user_id = '001';
        $message = 'test message';

        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->message = $message;
        $comment->post_date_time = $dummyTimestamp;

        $expected = [];
        $expected[] = $comment;

        sleep(1);
        $stub->addComment($user_id, $message);
        $actual = $stub->comments;

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testPublish()
    {
        $dummyTimestamp = (new DateTime())->getTimestamp();
        $publishComment = 'publish comment';

        $stub = $this->getMockBuilder(Report::class)
                     ->setMethods(['stampDateTime'])
                     ->getMock();
        $stub->method('stampDateTime')
            ->willReturn($dummyTimestamp);

        $expectedPublishDateTime = $dummyTimestamp;
        $expectedPublishComment  = $publishComment;

        $stub->publish($publishComment);
        $actualPublishDateTime = $stub->publish_date_time;
        $actualPublishComment  = $publishComment;

        $this->assertThat($actualPublishDateTime, $this->equalTo($expectedPublishDateTime));
        $this->assertThat($actualPublishComment, $this->equalTo($expectedPublishComment));
    }

    function testParse()
    {
        $comment = array('user_id' => 'taro',
                         'message' => 'great',
                         'post_date_time' => strtotime('2016-12-31 00:01:30'));
        $data = array('comments' => $comment);

        $expectedComment = new Comment();
        $expectedComment->message = $comment['message'];
        $expectedComment->post_date_time = $comment['post_date_time'];
        $expectedComment->user_id = $comment['user_id'];
        $expected = new Report();
        $expected->comments[] = $expectedComment;
        $actual = Report::parse($data);

        $this->assertThat($actual, $this->equalTo($expected));
    }
}
