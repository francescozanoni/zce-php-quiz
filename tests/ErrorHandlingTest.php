<?php

namespace Tests;

class ErrorHandlingTest extends TestCase
{

    private $basePath = __DIR__ . '/../src/error_handling';
    
    public function testErrors()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/errors.xml'));
    }

    public function testHandlingExceptions()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/handling_exceptions.xml'));
    }

    public function testThrowables()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/throwables.xml'));
    }
    
}
