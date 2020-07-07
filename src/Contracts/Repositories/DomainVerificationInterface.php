<?php

namespace SunAsterisk\DomainVerifier\Contracts\Repositories;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Models\DomainVerification as DomainVerificationModel;

interface DomainVerificationInterface
{
    /**
     * Get an existing or create a new domain verification record
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface  $domainVerifiable
     * @return DomainVerificationInterface
     */
    public function firstOrCreate(string $url, DomainVerifiableInterface $domainVerifiable): DomainVerificationModel;

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
     * @return DomainVerificationModel
     */
    public function setVerified(string $url, DomainVerifiableInterface $domainVerifiable): DomainVerificationModel;

    /**
     * Set verified domain by token
     *
     * @param  string  $token
     * @return void
     */
    public function setVerifiedByToken(string $token);
}
