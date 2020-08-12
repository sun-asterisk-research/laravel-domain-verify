<?php

namespace SunAsterisk\DomainVerifier\Contracts\Models;

use SunAsterisk\DomainVerifier\Models\DomainVerification;

interface DomainVerifiableInterface
{
    /**
     * Get unique key of domain verifiable
     *
     */
    public function getKey();

    /**
     * Get all the domain verification records
     *
     */
    public function domainVerifications();

    /**
     * Method that get called on verification success
     *
     */
    public function onVerificationSuccessByMail(DomainVerification $record);
}
