<?php

namespace SunAsterisk\DomainVerifier\Factories;

use SunAsterisk\DomainVerifier\Contracts\Strategies\VerifierStrategy;
use SunAsterisk\DomainVerifier\Enums\VerifierStrategy as EnumsVerifierStrategy;
use SunAsterisk\DomainVerifier\Strategies\DNSRecord;
use SunAsterisk\DomainVerifier\Strategies\HTMLFile;
use SunAsterisk\DomainVerifier\Strategies\HTMLMeta;
use SunAsterisk\DomainVerifier\Strategies\SendingMail;

class VerifierFactory
{
    public function strategy(string $strategyName): VerifierStrategy
    {
        switch ($strategyName) {
            case EnumsVerifierStrategy::DNS_RECORD:
                return new DNSRecord();
            case EnumsVerifierStrategy::HTML_FILE:
                return new HTMLFile();
            case EnumsVerifierStrategy::HTML_META:
                return new HTMLMeta();
            case EnumsVerifierStrategy::SENDING_MAIL:
                return new SendingMail();
        }

        throw new \InvalidArgumentException("Unsupported domain verification strategy: $strategyName");
    }
}
