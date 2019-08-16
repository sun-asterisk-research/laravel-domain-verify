<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;

class HTML implements StrategyInterface
{
    /**
     * Verfiy domain ownership via HTML meta tag
     *
     * @param  string  $url
     * @return bool
     */
    public function verify(string $url)
    {
        return false;
    }
}
