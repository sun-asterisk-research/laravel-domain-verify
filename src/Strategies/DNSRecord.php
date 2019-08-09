<?php

namespace SunAsterisk\DomainVerifier\Strategies;

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
