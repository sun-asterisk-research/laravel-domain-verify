<?php

namespace SunAsterisk\DomainVerifier\Factories;

use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\Strategies\DNSRecord;
use SunAsterisk\DomainVerifier\Strategies\HTMLMeta;
use SunAsterisk\DomainVerifier\Strategies\HTMLFile;
use SunAsterisk\DomainVerifier\Strategies\SendingMail;

class VerifierFactory
{
    public function strategy(string $strategyName): StrategyInterface
    {
        switch ($strategyName) {
            case 'dns-record':
                return new DNSRecord();
                break;
            case 'html-file':
                return new HTMLFile();
                break;
            case 'html-meta':
                return new HTMLMeta();
                break;
            case 'sending-mail':
                return new SendingMail();
                break;
        }

        throw new \InvalidArgumentException("Unsupported domain verification strategy: $strategyName");
    }
}
