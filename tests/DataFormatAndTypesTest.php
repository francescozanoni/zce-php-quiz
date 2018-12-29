<?php

namespace Tests;

class DataFormatAndTypesTest extends TestCase
{

    private $basePath = __DIR__ . '/../src/data_format_and_types';
    
    public function testDatetime()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/datetime.xml'));
    }

    public function testDomdocument()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/domdocument.xml'));
    }

    public function testJson()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/json.xml'));
    }

    public function testSimplexml()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/simplexml.xml'));
    }

    public function testSoap()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/soap.xml'));
    }

    public function testWebservicesBasics()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/webservices_basics.xml'));
    }

    public function testXmlBasics()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/xml_basics.xml'));
    }

    public function testXmlExtension()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/xml_extension.xml'));
    }
    
}
