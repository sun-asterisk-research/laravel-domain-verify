<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Models\DomainVerification;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\Results\VerifyResult;
use Spatie\Dns\Dns;

class DNSRecord extends BaseStrategy
{
    /**
     * Verify domain ownership via TXT record
     *
     * @param string $url
     * @param DomainVerifiableInterface $domainVerifiable
     * @return VerifyResult
     */
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable): VerifyResult
    {
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);

        if ($this->tokenExists($url, $record->token)) {
            $record->setVerified();
        } else {
            $record->setNotVerified();
        }

        return new VerifyResult($domainVerifiable, $url, $record);
    }

    protected function getTxtRecordValues($url)
    {
        $dns = new Dns($url);
        $txtRecords = $dns->getRecords('TXT');

        if (preg_match_all('/"([^"]+)"/', $txtRecords, $m)) {
            return $m[1];
        }

        return [];
    }

    protected function tokenExists($url, $token)
    {
        $verificationName = config('domain_verifier.verification_name');
        $txtRecordValues = $this->getTxtRecordValues($url);
        $verificationValue = "$verificationName=$token";

        return in_array($verificationValue, $txtRecordValues);
    }
}
