<?php

namespace SunAsterisk\DomainVerifier\Contracts\Repositories;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable;
use SunAsterisk\DomainVerifier\Models\DomainVerification as DomainVerificationModel;

interface VerificationRepository
{
    /**
     * Get an existing or create a new domain verification record
     *
     * @param  string  $url
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable  $domainVerifiable
     * @return \SunAsterisk\DomainVerifier\Models\DomainVerification
     */
    public function firstOrCreate(string $url, DomainVerifiable $domainVerifiable): DomainVerificationModel;

    /**
     * Get existing domain verification record by activation token
     *
     * @param  string  $activationToken
     * @return \SunAsterisk\DomainVerifier\Models\DomainVerification
     */
    public function findByActivationToken(string $activationToken): ?DomainVerificationModel;
}
