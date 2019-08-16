<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;

class Mail implements StrategyInterface
{
    /**
     * Verfiy domain ownership via administrator mail
     *
     * @param  string  $url
     * @return bool
     */
    public function verify(string $url)
    {
        return false;
    }
}
