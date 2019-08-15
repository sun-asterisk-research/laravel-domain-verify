<?php

namespace SunAsterisk\DomainVerifier\Tests\Strategies;

use PHPUnit\Framework\TestCase;
use SunAsterisk\DomainVerifier\Strategies\DNSRecord;

class DNSRecordTest extends TestCase
{
    public function test_it_can_verify_txt_record()
    {
        $url = 'https://domain.local';
        $result = (new DNSRecord)->verify($url);

        $this->assertInternalType('bool', $result);
    }
}
