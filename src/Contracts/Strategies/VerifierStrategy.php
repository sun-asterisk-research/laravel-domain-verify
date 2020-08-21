<?php

namespace SunAsterisk\DomainVerifier\Contracts\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable;
use SunAsterisk\DomainVerifier\Results\VerifyResult;

interface VerifierStrategy
{
    /**
     * Scan and check domain ownership
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable  $domainVerifiable
     * @return bool
     */
    public function verify(string $url, DomainVerifiable $domainVerifiable): VerifyResult;

    /**
     * Get verification token for URL and model
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable  $domainVerifiable
     * @return string
     */
    public function getToken(string $url, DomainVerifiable $domainVerifiable): string;
}
