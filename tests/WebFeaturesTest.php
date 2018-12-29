<?php

namespace Tests;

class WebFeaturesTest extends TestCase
{
    
    /**
     * @var string path to folder containing all XML files tested by this suite.
     */
    private $basePath = __DIR__ . '/../src/web_features';

    public function testCookies()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/cookies.xml'));
    }

    public function testForms()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/forms.xml'));
    }

    public function testGetAndPostData()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/get_and_post_data.xml'));
    }

    public function testHttpAuthentication()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/http_authentication.xml'));
    }

    public function testHttpHeaders()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/http_headers.xml'));
    }

    public function testHttpStatusCodes()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/http_status_codes.xml'));
    }

    public function testSessions()
    {
        $this->assertTrue($this->isValidXmlFile($this->basePath . '/sessions.xml'));
    }

}
