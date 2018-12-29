<?php

namespace Tests;

class ArraysTest extends TestCase
{

    private $basePath = __DIR__ . '/../src/arrays';
    
    public function testArrayFunctions()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/array_functions.xml'));
    }

    public function testArrayIteration()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/array_iteration.xml'));
    }

    public function testAssociativeArrays()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/associative_arrays.xml'));
    }

    public function testCasting()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/casting.xml'));
    }

    public function testSplObjectsAsArrays()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/spl_objects_as_arrays.xml'));
    }
    
}
