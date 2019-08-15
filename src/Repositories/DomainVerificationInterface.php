<?php

namespace SunAsterisk\DomainVerifier\Repositories;

use SunAsterisk\DomainVerifier\Models\DomainVerifiableInterface;

interface DomainVerificationInterface
{
    /**
     * Create domain verification
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Models\DomainVerifiableInterface  $domainVerifiable
     * @return string
     */
    public function create(string $url, DomainVerifiableInterface $domainVerifiable);

    /**
     * Get existing domain verification for site url
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Models\DomainVerifiableInterface  $domainVerifiable
     * @return \SunAsterisk\DomainVerifier\Models\DomainVerification
     */
    public function getTokenFor(string $url, DomainVerifiable $domainVerifiable);

    /**
     * Set verified domain
     *
     * @param  string $url
     * @param  \SunAsterisk\DomainVerifier\Models\DomainVerifiableInterface;  $verifiable
     * @return void
     */
    public function setVerified(string $url, DomainVerifiable $domainVerifiable);
}
