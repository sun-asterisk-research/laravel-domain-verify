<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\Results\VerifyResult;

class HTMLFile extends BaseStrategy
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
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);
        $verificationToken = $record->token;
        $domainToken = substr($this->getHtmlFileToken($url), 0, strlen($verificationToken));

        if ($domainToken === $verificationToken) {
            $record->setVerified();
        } else {
            $record->setNotVerified();
        }

        return new VerifyResult($domainVerifiable, $url, $record);
    }

    public function getHtmlFileUrl(string $url, DomainVerifiable $domainVerifiable): string
    {
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);

        $baseUrl = config('domain_verifier.base_url');

        return $baseUrl.'/domain-verify/html-file/'.$record->id;
    }

    protected function fileGetContents($url)
    {
        return file_get_contents($url);
    }

    protected function getHtmlFileToken($url)
    {
        $verificationName = config('domain_verifier.verification_name');
        $urlFile = $url.'/'.$verificationName.'.html';

        return $this->fileGetContents($urlFile);
    }
}
