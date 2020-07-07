<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\Results\VerifyResult;

abstract class BaseStrategy implements StrategyInterface
{
    abstract public function verify(string $url, DomainVerifiableInterface $domainVerifiable): VerifyResult;

    /**
     * Get token for verification process
     *
     * @param  string  $url
     * @param  DomainVerifiableInterface  $domainVerifiable
     * @return string
     */
    public function getToken(string $url, DomainVerifiableInterface $domainVerifiable): string
    {
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);
        return $record->token;
    }
}
