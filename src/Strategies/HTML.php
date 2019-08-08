<?php

namespace SunAsterisk\DomainVerifier\Strategies;

class HTML implements StrategyInterface
{
    /**
     * Verfiy domain ownership via HTML meta tag
     *
     * @param  string  $domain
     * @return bool
     */
    public function verify(string $domain)
    {
        return false;
    }
}
