<?php

namespace SunAsterisk\DomainVerifier\Repositories;

use SunAsterisk\DomainVerifier\Models\DomainVerifiable;

interface DomainVerificationInterface
{
    /**
     * Generate verification code
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Models\DomainVerifiable  $domainVerifiable
     * @return \SunAsterisk\DomainVerifier\Models\DomainVerification
     */
    public function generateToken(string $url, DomainVerifiable $domainVerifiable);

    /**
     * Get existing domain verification for site url
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Models\DomainVerifiable  $domainVerifiable
     * @return \SunAsterisk\DomainVerifier\Models\DomainVerification
     */
    public function getTokenFor(string $url, DomainVerifiable $domainVerifiable);
}
