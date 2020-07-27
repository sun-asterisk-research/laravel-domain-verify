<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use Illuminate\Support\Facades\Mail;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\Supports\URL;
use SunAsterisk\DomainVerifier\Results\VerifyResult;
use SunAsterisk\DomainVerifier\Mail\ActivationMail;

class SendingMail extends BaseStrategy
{
    /**
     * Verfiy domain ownership via administrator mail
     *
     * @param string $url
     * @param DomainVerifiableInterface $domainVerifiable
     * @return VerifyResult
     */
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable): VerifyResult
    {
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);
        return new VerifyResult($domainVerifiable, $url, $record);
    }

    public function verifyByActivationToken(string $activationToken): VerifyResult
    {
        $record = DomainVerificationFacade::findByActivationToken($activationToken);

        if ($record) {
            $record->setVerified();
            return new VerifyResult(null, $record->url, $record);
        }

        throw new \Exception('Activation token doesn\'t match to any verifiable object.');
    }

    public function sendMail(string $url, DomainVerifiableInterface $domainVerifiable): void
    {
        $domainName = URL::getDomainName($url);
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);

        Mail::send(new ActivationMail($domainVerifiable, $record, $url, $domainName, $record->activation_token));
    }

    public function setVerified(string $url, DomainVerifiableInterface $domainVerifiable): VerifyResult
    {
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);
        $record->setVerified();
        return new VerifyResult($domainVerifiable, $url, $record);
    }
}
