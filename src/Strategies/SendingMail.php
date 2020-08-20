<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use Illuminate\Support\Facades\Mail;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\Supports\URL;
use SunAsterisk\DomainVerifier\Results\VerifyResult;
use SunAsterisk\DomainVerifier\Mail\ActivationMail;
use Carbon\Carbon;

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
            $domainVerifiable = $record->verifiable;
            return new VerifyResult($domainVerifiable, $record->url, $record);
        }

        throw new \Exception('Activation token doesn\'t match to any verifiable object.');
    }

    public function sendMail(string $url, DomainVerifiableInterface $domainVerifiable, string $emailTo): void
    {
        $allowedEmailTo = ['admin', 'webmaster'];
        if (!in_array($emailTo, $allowedEmailTo)) {
            throw new \Exception('This mailbox name is not allowed.');
        }
        $domainName = URL::getDomainName($url);
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);
        $domainVerifiable = $record->verifiable;

        Mail::send(
            new ActivationMail($domainVerifiable, $record, $url, $domainName, $record->activation_token, $emailTo)
        );

        $record->update(['email_sent_at' => Carbon::now()]);
    }

    public function setVerified(string $url, DomainVerifiableInterface $domainVerifiable): VerifyResult
    {
        $record = DomainVerificationFacade::firstOrCreate($url, $domainVerifiable);
        $record->setVerified();
        return new VerifyResult($domainVerifiable, $url, $record);
    }
}
