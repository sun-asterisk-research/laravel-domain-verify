<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\Results\VerifyResult;

class HTMLFile extends BaseStrategy
{
    /**
     * Verify domain ownership via HTML meta tag
     *
     * @param string $url
     * @param DomainVerifiableInterface $domainVerifiable
     * @return bool
     */
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable)
    {
        $verificationToken = DomainVerificationFacade::getTokenFor($url, $domainVerifiable)->token;
        $domainToken = substr($this->getToken($url), 0, strlen($verificationToken));
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);

        if ($domainToken == $verificationToken) {
            $record = DomainVerificationFacade::setVerified($url, $domainVerifiable);
        }

        return new VerifyResult($domainVerifiable, $url, $record);
    }

    protected function getToken($url)
    {
        $verificationName = config('domain_verifier.verification_name');
        $urlFile = $url . './' . $verificationName . '.html';
        $domainToken = @file_get_contents($urlFile);
        return $domainToken;
    }

}
