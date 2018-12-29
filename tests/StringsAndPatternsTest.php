<?php

namespace Tests;

class StringsAndPatternsTest extends TestCase
{

    private $basePath = __DIR__ . '/../src/strings_and_patterns';
    
    public function testEncodings()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/encodings.xml'));
    }

    public function testExtracting()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/extracting.xml'));
    }

    public function testFormatting()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/formatting.xml'));
    }

    public function testMatching()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/matching.xml'));
    }

    public function testNowdoc()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/nowdoc.xml'));
    }

    public function testPcre()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/pcre.xml'));
    }

    public function testQuoting()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/quoting.xml'));
    }

    public function testReplacing()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/replacing.xml'));
    }

    public function testSearching()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/searching.xml'));
    }
    
}
