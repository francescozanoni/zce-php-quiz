<?php

namespace Tests;

class PhpBasicsTest extends TestCase
{

    private $basePath = __DIR__ . '/../src/php_basics';
    
    public function testConfig()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/config.xml'));
    }

    public function testControlStructures()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/control_structures.xml'));
    }

    public function testExtensions()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/extensions.xml'));
    }

    public function testLanguageConstructsAndFunctions()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/language_constructs_and_functions.xml'));
    }

    public function testNamespaces()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/namespaces.xml'));
    }

    public function testOperators()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/operators.xml'));
    }

    public function testPerformanceBytecodeCaching()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/performance_bytecode_caching.xml'));
    }

    public function testSyntax()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/syntax.xml'));
    }

    public function testVariables()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/variables.xml'));
    }
    
}
