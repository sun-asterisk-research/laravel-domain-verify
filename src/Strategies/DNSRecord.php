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
     * Verfiy domain ownership via TXT record
     *
     * @param string $url
     * @param DomainVerifiableInterface $domainVerifiable
     * @return bool
     */
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable)
    {
        $txtRecords = $this->getTxtRecords($url);
        $tokenRecords = $this->getTokenRecords($txtRecords);
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);

        if (in_array($record->token, $tokenRecords)) {
            $record->setVerified();
        }

        return new VerifyResult($domainVerifiable, $url, $record);
    }

    protected function getTxtRecords($url)
    {
        $dns = new Dns($url);
        $txtRecords = $dns->getRecords('TXT');

        return explode(PHP_EOL, $txtRecords);
    }

    protected function getTokenRecords($txtRecords)
    {
        $verificationName = config('domain_verifier.verification_name');
        $tokenRecords = [];

        foreach ($txtRecords as $item) {
            if (strpos($item, $verificationName)) {
                array_push($tokenRecords, substr($item, strpos($item, '=') + 2, -1));
            }
        }

        return $tokenRecords;
    }
}
