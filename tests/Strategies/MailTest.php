<?php

namespace SunAsterisk\DomainVerifier\Tests\Strategies;

use PHPUnit\Framework\TestCase;
use SunAsterisk\DomainVerifier\Strategies\Mail;

class MailTest extends TestCase
{
    public function test_it_can_verify_email_test()
    {
        $url = 'https://domain.local';
        $result = (new Mail)->verify($url);

        $this->assertInternalType('bool', $result);
    }
}
