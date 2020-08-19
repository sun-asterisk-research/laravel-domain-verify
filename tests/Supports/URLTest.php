<?php

namespace SunAsterisk\DomainVerifier\Tests\Supports;

use SunAsterisk\DomainVerifier\Tests\TestCase;
use SunAsterisk\DomainVerifier\Supports\URL;

class URLTest extends TestCase
{
    private $httpsURL = 'https://demo-example.domain.local/hello?fbclick=111&src=example';
    private $httpURL = 'http://demo-example.domain.local/hello?fbclick=111&src=example';
    private $httpURLWithPort = 'http://demo-example.domain.local:8000/hello?fbclick=111&src=example';

    public function testItCanNormalizeUrl()
    {
        $normalizedHttpsURL = URL::normalize($this->httpsURL);
        $normalizedHttpURL = URL::normalize($this->httpURL);
        $normalizedHttpURLWithPort = URL::normalize($this->httpURLWithPort);

        $this->assertSame('https://demo-example.domain.local', $normalizedHttpsURL);
        $this->assertSame('http://demo-example.domain.local', $normalizedHttpURL);
        $this->assertSame('http://demo-example.domain.local:8000', $normalizedHttpURLWithPort);
    }

    public function testItCanGetDomainName()
    {
        $domainHttpsURL = URL::getDomainName($this->httpsURL);
        $domainHttpURL = URL::getDomainName($this->httpURL);
        $domainHttpURLWithPort = URL::getDomainName($this->httpURLWithPort);

        $this->assertSame('demo-example.domain.local', $domainHttpsURL);
        $this->assertSame('demo-example.domain.local', $domainHttpURL);
        $this->assertSame('demo-example.domain.local', $domainHttpURLWithPort);
    }
}
