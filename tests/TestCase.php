<?php

namespace Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{

    /**
     * @var bool value of XML error handling before executing test suite.
     */
    private static $libxmlUseInternalErrors;

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

        $xml = new \DOMDocument();
        $xml->load($xmlFilePath);

        return $xml->schemaValidate($this->xsdFilePath);

    }

    public static function setUpBeforeClass()
    {

        // Enable XML user error handling.
        self::$libxmlUseInternalErrors = libxml_use_internal_errors(true);

    }

    public static function tearDownAfterClass()
    {

        // Restore previous value of XML error handling.
        libxml_use_internal_errors(self::$libxmlUseInternalErrors);

    }

}
