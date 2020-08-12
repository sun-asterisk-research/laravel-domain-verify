<?php

namespace SunAsterisk\DomainVerifier\Traits;

use SunAsterisk\DomainVerifier\Models\DomainVerification;

trait DomainVerifiable
{
    public function domainVerifications()
    {
        return $this->morphToMany(DomainVerification::class, 'verifiable');
    }

    public function onVerificationSuccessByMail(DomainVerification $record)
    {
        return;
    }
}
