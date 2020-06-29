<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\Results\VerifyResult;
use SunAsterisk\DomainVerifier\Models\DomainVerification;

class HTMLFile extends BaseStrategy
{
    /**
     * Verify domain ownership via HTML meta tag
     *
     * @param string $url
     * @param DomainVerifiableInterface $domainVerifiable
     * @return bool
     */
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable): VerifyResult
    {
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);
        $verificationToken = $record->token;
        $domainToken = substr($this->getHtmlFileToken($url), 0, strlen($verificationToken));

        if ($domainToken === $verificationToken) {
            $record->setVerified();
        }

        return new VerifyResult($domainVerifiable, $url, $record);
    }

    protected function getHtmlFileToken($url)
    {
        $verificationName = config('domain_verifier.verification_name');
        $urlFile = $url . '/' . $verificationName . '.html';
        $domainToken = @file_get_contents($urlFile);
        return $domainToken;
    }

}
