<?php

namespace SunAsterisk\DomainVerifier\Contracts\Strategies;

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
