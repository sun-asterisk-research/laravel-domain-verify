<?php

namespace SunAsterisk\DomainVerifier\Results;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Models\DomainVerification;

class VerifyResult
{
    protected $domainVerifiable;
    protected $url;
    protected $record;

    public function __construct(DomainVerifiableInterface $domainVerifiable, string $url, DomainVerification $record)
    {
        $this->domainVerifiable = $domainVerifiable;
        $this->url = $url;
        $this->record = $record;
    }

    public function isVerified()
    {
        return $this->record->status === 'verified';
    }

    public function getStatus()
    {
        return $this->record->status;
    }
}
