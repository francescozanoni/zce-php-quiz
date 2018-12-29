<?php

namespace Tests;

class DatabasesAndSqlTest extends TestCase
{
    
    /**
     * @var string path to folder containing all XML files tested by this suite.
     */
    private $basePath = __DIR__ . '/../src/databases_and_sql';

    public function testJoins()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/joins.xml'));
    }

    public function testPdo()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/pdo.xml'));
    }

    public function testPreparedStatements()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/prepared_statements.xml'));
    }

    public function testSql()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/sql.xml'));
    }

    public function testTransactions()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/transactions.xml'));
    }

}
