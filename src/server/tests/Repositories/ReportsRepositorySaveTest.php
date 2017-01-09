<?php

class ReportsRepositorySaveTest extends PHPUnit_Extensions_Database_TestCase
{
    static private $pdo = null;

    private $conn = null;
    private $privateMethod = null; // Temporary Private Method Mock

    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }
        return $this->conn;
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__).'/_files/reports-seed2.xml');
    }

    function setup()
    {
        parent::setup();
        $methodName = $this->getName(); // test method name
        $methodName = preg_replace_callback('/^test./'
                                           , function($m) { return strtolower(substr($m[0], 4)); }
                                           , $methodName);
        $classInfo = new ReflectionClass('ReportsRepository');
        foreach ($classInfo->getMethods() as $method) {
            if ($method->name == $methodName) {
                $method->setAccessible(TRUE);
                $this->privateMethod = $method;
            }
        }
    }

    function testSave()
    {
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);

        $expected = (object) Array('year'              => 2016,
                                   'weeknum'           => 1,
                                   'user_id'           => 1,
                                   'publish_date_time' => '2016-01-01 11:22:33',
                                   'publish_comment'   => 'publish_comment');

        $aReport = new Report();
        $aReport->year              = 2016;
        $aReport->weeknum           = 1;
        $aReport->user_id           = 1;
        $aReport->publish_date_time = new DateTime('2016-01-01 11:22:33');
        $aReport->publish_comment   = 'publish_comment';
        $repository->save($aReport);

        $actual = $db->getSingleResult("SELECT * FROM weekly_reports WHERE year = ? AND weeknum = ? AND user_id = ?"
                                      , 2016, 1, 1);

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testSaveItems()
    {
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);

        $expected = (object) Array('year'      => 2016,
                                   'weeknum'   => 1,
                                   'user_id'   => 1,
                                   'item_name' => 'Jisseki',
                                   'content'   => 'test_content');

        $aReport = new Report();
        $aReport->year            = 2016;
        $aReport->weeknum         = 1;
        $aReport->user_id         = 1;
        $aReport->data['Jisseki'] = 'test_content';

        $this->privateMethod->InvokeArgs($repository, [$aReport]);

        $actual = $db->getSingleResult("SELECT * FROM weekly_report_items WHERE year = ? AND weeknum = ? AND user_id = ? AND item_name = ?"
                                      , 2016, 1, 1, 'Jisseki');

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testSavePublication()
    {
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);

        $expected = (object) Array('year'              => '2016',
                                   'weeknum'           => '1',
                                   'user_id'           => '1',
                                   'publish_date_time' => '2016-01-01 11:22:33',
                                   'publish_comment'   => 'test_comment');

        $aReport = new Report();
        $aReport->year              = 2016;
        $aReport->weeknum           = 1;
        $aReport->user_id           = 1;
        $aReport->publish_date_time = new DateTime('2016-01-01 11:22:33');
        $aReport->publish_comment   = 'test_comment';

        $this->privateMethod->InvokeArgs($repository, [$aReport]);

        $actual = $db->getSingleResult('SELECT * FROM weekly_reports WHERE year = ? AND weeknum = ? AND user_id = ?'
                                      , 2016, 1, 1);

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testSaveComments()
    {
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);

        $expected = (object) Array('year'           => 2016,
                                   'weeknum'        => 1,
                                   'user_id'        => 1,
                                   'index'          => 1,
                                   'sender_user_id' => 2,
                                   'message'        => 'test_message',
                                   'post_date_time' => '2016-01-01 11:22:33');

        $aComment = new Comment();
        $aComment->user_id        = 2;
        $aComment->message        = 'test_message';
        $aComment->post_date_time = new DateTime('2016-01-01 11:22:33');

        $aReport = new Report();
        $aReport->year       = 2016;
        $aReport->weeknum    = 1;
        $aReport->user_id    = 1;
        $aReport->comments[] = $aComment;

        $this->privateMethod->InvokeArgs($repository, [$aReport]);

        $actual = $db->getSingleResult('SELECT * FROM weekly_report_comments WHERE year = ? AND weeknum = ? AND user_id = ? AND "index" = ?'
                                      , 2016, 1, 1, 1);

        $this->assertThat($actual, $this->equalTo($expected));
    }
}
