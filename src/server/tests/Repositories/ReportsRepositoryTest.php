<?php

class ReportsRepositoryTest extends PHPUnit_Extensions_Database_TestCase {

    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        $pdo = new PDO("sqlite:" . __DIR__ . '/../../db/weekly_reports.sqlite3');
        return $this->createDefaultDBConnection($pdo, ':memory:');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__).'/_files/reports-seed.xml');
    }

    function testFindById() {
        $dataSet = $this->getConnection()->createDataSet();
        $db = Db::getInstance();
        $repository = new ReportsRepository($db);
        $report = $repository->findById(2016, 1, 1);

    }
}