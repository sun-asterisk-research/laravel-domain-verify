<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use Spatie\Dns\Dns;

class DNSRecord implements StrategyInterface
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
        $verificationToken = DomainVerificationFacade::getTokenFor($url, $domainVerifiable)->token;

        return in_array($verificationToken, $tokenRecords);
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
        $tokenRecords = array();

        foreach ($txtRecords as $item) {
            if (strpos($item, $verificationName)) {
                array_push($tokenRecords, substr($item, strpos($item, '=') + 2, -1));
            }
        }

        return $tokenRecords;
    }
}
