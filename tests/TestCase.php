<?php

namespace Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{

    /**
     * @var string XSD schema file path, used to validate XML files.
     */
    private $xsdFilePath = __DIR__ . '/../schema.xsd';
  
    /**
     * Check whether an XML file is valid.
     *
     * @param string $xmlFilePath
     *
     * @return bool
     */
    protected function isValidXmlFile($xmlFilePath)
    {
        
        // Enable user error handling.
        $previousSettingValue = libxml_use_internal_errors(true);

        $xml = new \DOMDocument();
        $xml->load($xmlFilePath);

        $result = $xml->schemaValidate($this->xsdFilePath);
        
        // Disable user error handling (if it was disabled before this code).
        libxml_use_internal_errors($previousSettingValue);
        
        return $result;
        
    }
    
}