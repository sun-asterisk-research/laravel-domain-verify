<?php

namespace SunAsterisk\DomainVerifier\Tests\Supports;

use PHPUnit\Framework\TestCase;
use SunAsterisk\DomainVerifier\Supports\URL;

class URLTest extends TestCase
{
    public function test_it_can_normalize_url()
    {
        $httpsURL = 'https://demo-example.domain.local/hello?fbclick=111&src=example';
        $httpURL = 'http://demo-example.domain.local/hello?fbclick=111&src=example';
        $httpURLWithPort = 'http://demo-example.domain.local:8000/hello?fbclick=111&src=example';

        $normalizedHttpsURL = URL::normalize($httpsURL);
        $normalizedHttpURL = URL::normalize($httpURL);
        $normalizedHttpURLWithPort = URL::normalize($httpURLWithPort);

        $this->assertSame('https://demo-example.domain.local', $normalizedHttpsURL);
        $this->assertSame('http://demo-example.domain.local', $normalizedHttpURL);
        $this->assertSame('http://demo-example.domain.local:8000', $normalizedHttpURLWithPort);
    }
}
