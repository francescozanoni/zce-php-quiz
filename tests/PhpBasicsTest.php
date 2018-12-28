<?php
use PHPUnit\Framework\TestCase;

class PhpBasicsTest extends TestCase
{
    public function testSyntax()
    {
        $xmlFilePath = __DIR__ . '/../src/php_basics/syntax.xml';
        $xsdFilePath = __DIR__ . '/../schema.xsd';

        // Enable user error handling
        libxml_use_internal_errors(true);

        $xml = new DOMDocument();
        $xml->load($xmlFilePath);

        $this->assertTrue($xml->schemaValidate($xsdFilePath));
    }
}
