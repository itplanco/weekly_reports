<?php

class ReportsRepositoryFindTest extends PHPUnit_Extensions_Database_TestCase
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
        return $this->createFlatXMLDataSet(dirname(__FILE__).'/_files/reports-seed1.xml');
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

    function testFindItemById()
    {
        $dataSet = $this->getConnection()->createDataSet();
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);

        $expected = (object) array('year'      => '2016'
                                  ,'weeknum'   => '1'
                                  ,'user_id'   => '1'
                                  ,'item_name' => 'test_key1'
                                  ,'content'   => 'test_content1');
        $actual = $repository->findItemById(2016, 1, 1, 'test_key1');

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testFindItemsById()
    {
        $dataSet = $this->getConnection()->createDataSet();
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);

        $expected   = [];
        $expected[] = (object) array('year'      => '2016'
                                    ,'weeknum'   => '1'
                                    ,'user_id'   => '1'
                                    ,'item_name' => 'test_key1'
                                    ,'content'   => 'test_content1');
        $expected[] = (object) array('year'      => '2016'
                                    ,'weeknum'   => '1'
                                    ,'user_id'   => '1'
                                    ,'item_name' => 'test_key2'
                                    ,'content'   => 'test_content2');

        $actual = $this->privateMethod->invokeArgs($repository, [2016, 1, 1]);

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testFindPublicationById()
    {
        $dataSet = $this->getConnection()->createDataSet();
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);

        $expected = new Report();
        $expected->year              = '2016';
        $expected->weeknum           = '1';
        $expected->user_id           = '1';
        $expected->publish_date_time = new DateTime('2016-01-01 11:22:33');
        $expected->publish_comment   = 'publish_comment';

        $actual = $this->privateMethod->invokeArgs($repository, [2016, 1, 1]);

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testFindCommentsById()
    {
        $dataSet = $this->getConnection()->createDataSet();
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);

        $expected   = [];
        $expected[] = (object) array('year'           => '2016'
                                    ,'weeknum'        => '1'
                                    ,'user_id'        => '1'
                                    ,'sender_user_id' => '2'
                                    ,'message'        => 'test_message'
                                    ,'post_date_time' => '2016-01-01 12:34:56'
                                    ,'index'          => '1');

        $actual = $this->privateMethod->invokeArgs($repository, [2016, 1, 1]);

        $this->assertThat($actual, $this->equalTo($expected));
    }

    function testFindById() {
        $dataSet = $this->getConnection()->createDataSet();
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);

        $expected = new Report();
        $expected->year = 2016;
        $expected->weeknum = 1;
        $expected->user_id = 1;
        $expected->data    = array('test_key1' => 'test_content1'
                                  ,'test_key2' => 'test_content2');
        $expected->publish_date_time = new Datetime('2016-01-01 11:22:33');
        $expected->publish_comment = 'publish_comment';
        $aComment = new Comment();
        $aComment->user_id = '2';
        $aComment->message = 'test_message';
        $aComment->post_date_time = new Datetime('2016-01-01 12:34:56');
        $expected->comments[] = $aComment;

        $actual = $repository->findById(2016, 1, 1);

        $this->assertThat($actual, $this->equalTo($expected));
    }

}

