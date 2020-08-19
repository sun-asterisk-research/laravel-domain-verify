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
     * @param  DomainVerifiableInterface  $domainVerifiable
     * @return DomainVerificationModel
     */
    public function firstOrCreate(string $url, DomainVerifiableInterface $domainVerifiable): DomainVerificationModel;

    /**
     * Get existing domain verification record by activation token
     *
     * @param  string  $activationToken
     * @return DomainVerificationModel
     */
    public function findByActivationToken(string $activationToken): ?DomainVerificationModel;
}
