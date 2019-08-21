<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;

class HTML implements StrategyInterface
{
    /**
     * Verfiy domain ownership via HTML meta tag
     *
     * @param string $url
     * @param DomainVerifiableInterface $domainVerifiable
     * @return bool
     */
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable)
    {
        $tags = get_meta_tags($url);
        $verification_name = config("domain_verifier.verification_name");
        if (!isset($tags[$verification_name])) {
            return false;
        }
        $domain_token = $tags[$verification_name];
        $verification_token = DomainVerificationFacade::getTokenFor($url, $domainVerifiable)->token;
        return $domain_token == $verification_token;
    }
}
