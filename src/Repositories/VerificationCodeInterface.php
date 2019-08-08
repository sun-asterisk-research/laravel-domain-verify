<?php

namespace SunAsterisk\DomainVerifier\Repositories;

interface VerificationCodeInterface
{
    /**
     * Generate verification code
     *
     * @param  string  $domain
     * @param  \SunAsterisk\DomainVerifier\Models\DomainVerifiable  $domainVerifiable
     * @return \SunAsterisk\DomainVerifier\Models\VerificationCode
     */
    public function generateToken(string $domain, DomainVerifiable $domainVerifiable);

    /**
     * Undocumented function
     *
     * @param  \SunAsterisk\DomainVerifier\Models\DomainVerifiable  $domainVerifiable
     * @return \SunAsterisk\DomainVerifier\Models\VerificationCode
     */
    public function getTokenFor(DomainVerifiable $domainVerifiable);
}
