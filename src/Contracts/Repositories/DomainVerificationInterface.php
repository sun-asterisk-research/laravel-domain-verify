<?php

namespace SunAsterisk\DomainVerifier\Contracts\Repositories;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;

interface DomainVerificationInterface
{
    /**
     * Create domain verification
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface  $domainVerifiable
     * @return string
     */
    public function create(string $url, DomainVerifiableInterface $domainVerifiable);

    /**
     * Get existing domain verification for site url
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface  $domainVerifiable
     * @return \SunAsterisk\DomainVerifier\Models\DomainVerification
     */
    public function getTokenFor(string $url, DomainVerifiableInterface $domainVerifiable);

    /**
     * Get existing domain verification by token
     *
     * @param string $token
     * @return \SunAsterisk\DomainVerifier\Models\DomainVerification
     */
    public function getByToken(string $token);

    /**
     * Set verified domain
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface  $verifiable
     * @return void
     */
    public function setVerified(string $url, DomainVerifiableInterface $domainVerifiable);

    /**
     * Set verified domain by token
     *
     * @param  string  $token
     * @return void
     */
    public function setVerifiedByToken(string $token);
}
