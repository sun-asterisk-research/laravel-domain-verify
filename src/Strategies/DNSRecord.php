<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;

class DNSRecord implements StrategyInterface
{
    /**
     * Verfiy domain ownership via TXT record
     *
     * @param  string  $url
     * @return bool
     */
    public function verify(string $url)
    {
        return false;
    }
}
