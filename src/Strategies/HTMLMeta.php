<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\Results\VerifyResult;

class HTMLMeta extends BaseStrategy
{
    /**
     * Verify domain ownership via HTML meta tag
     *
     * @param  string  $url
     * @param  DomainVerifiable  $domainVerifiable
     * @return VerifyResult
     */
    public function verify(string $url, DomainVerifiable $domainVerifiable): VerifyResult
    {
        $metaTags = $this->getMetaTags($url);
        $domainToken = $this->getMetaTagToken($metaTags);
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);

        if ($record->token === $domainToken) {
            $record->setVerified();
        } else {
            $record->setNotVerified();
        }

        return new VerifyResult($domainVerifiable, $url, $record);
    }

    protected function getMetaTags($url)
    {
        return get_meta_tags($url);
    }

    protected function getMetaTagToken(array $metaTags)
    {
        $verificationName = config('domain_verifier.verification_name');
        if (!isset($metaTags[$verificationName])) {
            return '';
        }

        return $metaTags[$verificationName];
    }
}
