<?php
namespace Tests;

class PhpBasicsTest extends QuizTestCase
{

    private $basePath = __DIR__ . '/../src/php_basics';
    
    public function testSyntax()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/syntax.xml'));
    }
    
}
