<?php

namespace SunAsterisk\DomainVerifier\Strategies;

interface StrategyInterface
{
    /**
     * Scan and check domain ownership
     *
     * @param  string  $domain
     * @return bool
     */
    public function verify(string $domain);
}
