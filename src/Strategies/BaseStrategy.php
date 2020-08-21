<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable;
use SunAsterisk\DomainVerifier\Contracts\Strategies\VerifierStrategy;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\Models\DomainVerification;
use SunAsterisk\DomainVerifier\Results\VerifyResult;
use SunAsterisk\DomainVerifier\Supports\URL;

abstract class BaseStrategy implements VerifierStrategy
{
    abstract public function verify(string $url, DomainVerifiable $domainVerifiable): VerifyResult;

    /**
     * Get token for verification process
     *
     * @param  string  $url
     * @param  DomainVerifiable  $domainVerifiable
     * @return string
     */
    public function getToken(string $url, DomainVerifiable $domainVerifiable): string
    {
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);

        return $record->token;
    }

    public function getDomainName(string $url): string
    {
        return URL::getDomainName($url);
    }

    public function getRecord(string $url, DomainVerifiable $domainVerifiable): DomainVerification
    {
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);

        return $record->token;
    }
}
