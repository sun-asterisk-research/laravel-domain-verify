<?php

namespace SunAsterisk\DomainVerifier\Mail;

use Illuminate\Mail\Mailable;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Models\DomainVerification;

class ActivationMail extends Mailable
{
    public DomainVerifiableInterface $verifiable;

    public DomainVerification $verification;

    public string $domainName;

    public string $activationToken;

    public function __construct(
        DomainVerifiableInterface $verifiable,
        DomainVerification $verification,
        string $url,
        string $domainName,
        string $activationToken
    ) {
        $this->verifiable = $verifiable;
        $this->verification = $verification;
        $this->url = $url;
        $this->domainName = $domainName;
        $this->activationToken = $activationToken;
    }

    public function build()
    {
        $mailFrom = config('domain_verifier.mail.from');
        $mailTo = 'admin@' . $this->domainName;
        $mailCc = 'webmaster@' . $this->domainName;
        $mailSubject = config('domain_verifier.mail.subject');
        $mailView = config('domain_verifier.mail.view');

        $activationUrl = request()->root() . '/domain-verify/' . $this->activationToken;

        return $this
            ->from($mailFrom)
            ->to($mailTo)
            ->cc($mailCc)
            ->subject($mailSubject)
            ->view($mailView)
            ->with([
                'url' => $this->url,
                'domainName' => $this->domainName,
                'activationToken' => $this->activationToken,
                'activationUrl' => $activationUrl,
            ]);
    }
}
