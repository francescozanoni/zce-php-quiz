<?php

namespace Tests;

class IOTest extends TestCase
{

    private $basePath = __DIR__ . '/../src/i_o';
    
    public function testContexts()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/contexts.xml'));
    }

    public function testFileSystemFunctions()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/file_system_functions.xml'));
    }

    public function testFiles()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/files.xml'));
    }

    public function testReading()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/reading.xml'));
    }

    public function testStreams()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/streams.xml'));
    }

    public function testWriting()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/writing.xml'));
    }
    
}
