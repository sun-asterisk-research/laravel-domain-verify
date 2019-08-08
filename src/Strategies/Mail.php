<?php

namespace SunAsterisk\DomainVerifier\Strategies;

class Mail implements StrategyInterface
{
    /**
     * Verfiy domain ownership via administrator mail
     *
     * @param  string  $domain
     * @return bool
     */
    public function verify(string $domain)
    {
        return false;
    }
}
