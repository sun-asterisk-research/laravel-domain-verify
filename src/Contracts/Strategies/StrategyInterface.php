<?php

namespace SunAsterisk\DomainVerifier\Contracts\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;

interface StrategyInterface
{
    /**
     * Scan and check domain ownership
     *
     * @param string $url
     * @param DomainVerifiableInterface $domainVerifiable
     * @return bool
     */
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable);
}
