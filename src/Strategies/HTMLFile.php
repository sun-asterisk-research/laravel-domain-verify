<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;

class HTMLFile implements StrategyInterface
{
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable)
    {
        $verificationName = config("domain_verifier.verification_name");
        $urlFile = $url.'./'.$verificationName.'.html';
        $domainToken = @file_get_contents($urlFile);
        if ($domainToken == null) return false;
        $verificationToken = DomainVerificationFacade::getTokenFor($url, $domainVerifiable)->token;
        $n = strlen($verificationToken);
        $domainToken = substr($domainToken, 0, $n);
        return $domainToken == $verificationToken;
    }
}
