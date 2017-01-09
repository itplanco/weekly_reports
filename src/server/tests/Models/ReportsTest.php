<?php

use PHPUnit\Framework\TestCase;

class ReportsTest extends TestCase {
    /**
     * @dataProvider testAddDataAdditionProvider
     */
    function testAddData($entrydata, $expected) {
        $cut = new Report();
        foreach ($entrydata as $key => $value) $cut->addData($key, $value);
        $actual = $cut->data;
        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testAddDataAdditionProvider()
    {
        return [
            'zero' => [[], []],
            'one'  => [
                ['a'=>'b'],
                ['a'=>'b']
            ],
            'two'  => [
                ['A'=>'1','B'=>'2'],
                ['A'=>'1','B'=>'2']
            ]
        ];
    }

    /**
     * @dataProvider testAddCommentAdditionProvider
     */
    function testAddComment($entrydata, $expected)
    {
        $dummyTimestamp = new DateTime('2016-01-01 11:11:11');

        $stub = $this->getMockBuilder(Report::class)
                     ->setMethods(['stampDateTime'])
                     ->getMock();
        $stub->method('stampDateTime')
             ->willReturn($dummyTimestamp);

        foreach ($entrydata as $d) {
            $d = (Object)$d;
            $stub->addComment($d->user_id, $d->message);
        }
        $actual = $stub->comments;

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testAddCommentAdditionProvider()
    {
        $comment1 = new Comment();
        $comment1->user_id = 'user1';
        $comment1->message = 'message1';
        $comment1->post_date_time = new DateTime('2016-01-01 11:11:11');

        $comment2 = new Comment();
        $comment2->user_id = 'user2';
        $comment2->message = 'message2';
        $comment2->post_date_time = new DateTime('2016-01-01 11:11:11');

        return [
            'zero' => [[], []],
            'one'  => [
                [['user_id'=>'user1', 'message'=>'message1']],
                [$comment1]
            ],
            'two'  => [
                [['user_id'=>'user1', 'message'=>'message1'], ['user_id'=>'user2', 'message'=>'message2']],
                [$comment1, $comment2]
            ]
        ];
    }

    /**
     * @dataProvider testPublishAdditionProvider
     */
    function testPublish($entrydata, $expectedPublishComment)
    {
        $dummyTimestamp = (new DateTime())->getTimestamp();

        $stub = $this->getMockBuilder(Report::class)
                     ->setMethods(['stampDateTime'])
                     ->getMock();
        $stub->method('stampDateTime')
            ->willReturn($dummyTimestamp);

        $expectedPublishDateTime = $dummyTimestamp;

        $stub->publish($entrydata);
        $actualPublishDateTime = $stub->publish_date_time;
        $actualPublishComment  = $stub->publish_comment;

        $this->assertThat($actualPublishDateTime, $this->equalTo($expectedPublishDateTime));
        $this->assertThat($actualPublishComment, $this->equalTo($expectedPublishComment));
    }

    function testPublishAdditionProvider()
    {
        return [
            'null' => [null, null],
            'one'  => ['test_publish_comment', 'test_publish_comment'],
        ];
    }
}
