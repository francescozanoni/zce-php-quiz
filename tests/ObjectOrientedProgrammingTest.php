<?php

namespace Tests;

class ObjectOrientedProgrammingTest extends TestCase
{

    private $basePath = __DIR__ . '/../src/object_oriented_programming';
    
    public function testAutoload()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/autoload.xml'));
    }

    public function testClassConstants()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/class_constants.xml'));
    }

    public function testInstanceMethodsAndProperties()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/instance_methods_and_properties.xml'));
    }

    public function testInstantiation()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/instantiation.xml'));
    }

    public function testInterfaces()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/interfaces.xml'));
    }

    public function testLateStaticBinding()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/late_static_binding.xml'));
    }

    public function testMagicMethods()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/magic_methods.xml'));
    }

    public function testModifiersInheritance()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/modifiers_inheritance.xml'));
    }

    public function testReflection()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/reflection.xml'));
    }

    public function testReturnTypes()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/return_types.xml'));
    }

    public function testSpl()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/spl.xml'));
    }

    public function testTraits()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/traits.xml'));
    }

    public function testTypeHinting()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/type_hinting.xml'));
    }
    
}
