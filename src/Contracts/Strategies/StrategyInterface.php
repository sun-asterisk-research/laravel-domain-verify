<?php

namespace SunAsterisk\DomainVerifier\Contracts\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Results\VerifyResult;

interface StrategyInterface
{
    /**
     * Scan and check domain ownership
     *
     * @param  string  $url
     * @param  DomainVerifiableInterface  $domainVerifiable
     * @return bool
     */
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable): VerifyResult;

    /**
     * Get verification token for URL and model
     *
     * @param  string  $url
     * @param  string  $domainVerifiable
     * @return string
     */
    public function getToken(string $url, DomainVerifiableInterface $domainVerifiable): string;
}
