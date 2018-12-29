<?php

namespace Tests;

class SecurityTest extends TestCase
{

    private $basePath = __DIR__ . '/../src/security';
    
    public function testConfiguration()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/configuration.xml'));
    }

    public function testCrossSiteRequestForgeries()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/cross_site_request_forgeries.xml'));
    }

    public function testCrossSiteScripting()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/cross_site_scripting.xml'));
    }

    public function testEmailInjection()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/email_injection.xml'));
    }

    public function testEncryptionHashingAlgorithms()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/encryption_hashing_algorithms.xml'));
    }

    public function testEscapeOutput()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/escape_output.xml'));
    }

    public function testFileUploads()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/file_uploads.xml'));
    }

    public function testFilterInput()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/filter_input.xml'));
    }

    public function testPasswordHashingApi()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/password_hashing_api.xml'));
    }

    public function testPhpConfiguration()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/php_configuration.xml'));
    }

    public function testRemoteCodeInjection()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/remote_code_injection.xml'));
    }

    public function testSessionSecurity()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/session_security.xml'));
    }

    public function testSqlInjection()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/sql_injection.xml'));
    }
    
}
