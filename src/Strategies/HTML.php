<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use Mockery as m;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;

class HTML implements StrategyInterface
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
        $metaTags = $this->getMetaTags($url);
        $domainToken = $this->getToken($metaTags);
        $token = DomainVerificationFacade::getTokenFor($url, $domainVerifiable)->token;

        return $token === $domainToken;
    }

    protected function getMetaTags($url)
    {
        return get_meta_tags($url);
    }

    protected function getToken(array $metaTags)
    {
        // do somethings
        $verificationName = config("domain_verifier.verification_name");
        if (!isset($metaTags[$verificationName])) {
            return "";
        }
        return $metaTags[$verificationName];
    }
}
