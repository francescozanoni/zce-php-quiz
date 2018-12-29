<?php

namespace Tests;

class FunctionsTest extends TestCase
{

    private $basePath = __DIR__ . '/../src/functions';
    
    public function testAnonymousFunctionsClosures()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/anonymous_functions_closures.xml'));
    }

    public function testArguments()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/arguments.xml'));
    }

    public function testConfig()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/config.xml'));
    }

    public function testReferences()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/references.xml'));
    }

    public function testReturns()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/returns.xml'));
    }

    public function testTypeDeclarations()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/type_declarations.xml'));
    }

    public function testVariableScope()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/variable_scope.xml'));
    }

    public function testVariables()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/variables.xml'));
    }
    
}
