<?php

namespace SunAsterisk\DomainVerifier\Tests\Strategies;

use PHPUnit\Framework\TestCase;
use SunAsterisk\DomainVerifier\Strategies\HTML;

class HTMLTest extends TestCase
{
    public function test_it_can_verify_html_tag()
    {
        $url = 'https://domain.local';
        $result = (new HTML)->verify($url);

        $this->assertInternalType('bool', $result);
    }
}
