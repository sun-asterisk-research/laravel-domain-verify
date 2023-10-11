<?php

namespace SunAsterisk\DomainVerifier\Results;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable;
use SunAsterisk\DomainVerifier\Models\DomainVerification;

class VerifyResult
{
    protected $domainVerifiable;
    protected $url;
    protected $record;

    public function __construct(?DomainVerifiable $domainVerifiable, string $url, DomainVerification $record)
    {
        $this->domainVerifiable = $domainVerifiable;
        $this->url = $url;
        $this->record = $record;
    }

    public function getVerifiable()
    {
        return $this->domainVerifiable;
    }

    public function getRecord()
    {
        return $this->record;
    }

    public function isVerified()
    {
        return $this->record->status === 'verified';
    }

    public function getStatus()
    {
        return $this->record->status;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
