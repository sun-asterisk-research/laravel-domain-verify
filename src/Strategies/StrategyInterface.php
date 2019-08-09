<?php

namespace SunAsterisk\DomainVerifier\Strategies;

interface StrategyInterface
{
    /**
     * Scan and check domain ownership
     *
     * @param  string  $url
     * @return bool
     */
    public function verify(string $url);
}
