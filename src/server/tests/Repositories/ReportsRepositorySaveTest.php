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

    function testSave()
    {
        $dataSet = $this->getConnection()->createDataSet();
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

}
