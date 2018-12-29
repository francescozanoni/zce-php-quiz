<?php
namespace Tests;

class PhpBasicsTest extends QuizTestCase
{
    public function testSyntax()
    {
        $xmlFilePath = __DIR__ . '/../src/php_basics/syntax.xml';
        
        // Enable user error handling
        libxml_use_internal_errors(true);

        $xml = new \DOMDocument();
        $xml->load($xmlFilePath);

        $this->assertTrue($xml->schemaValidate($this->xsdFilePath));
    }
}
