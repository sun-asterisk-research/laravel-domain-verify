<?php

namespace SunAsterisk\DomainVerifier\Mail;

use Illuminate\Mail\Mailable;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable;
use SunAsterisk\DomainVerifier\Models\DomainVerification;

class ActivationMail extends Mailable
{
    public $verifiable;

    public $verification;

    public $domainName;

    public $activationToken;

    public $emailTo;

    /**
     * Constructor
     *
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable $verifiable
     * @param  \SunAsterisk\DomainVerifier\Models\DomainVerification $verification
     * @param  string $url
     * @param  string $domainName
     * @param  string $activationToken
     * @param  string $emailTo
     */
    public function __construct(
        DomainVerifiable $verifiable,
        DomainVerification $verification,
        string $url,
        string $domainName,
        string $activationToken,
        string $emailTo
    ) {
        $this->verifiable = $verifiable;
        $this->verification = $verification;
        $this->url = $url;
        $this->domainName = $domainName;
        $this->activationToken = $activationToken;
        $this->emailTo = $emailTo;
    }

    public function build()
    {
        $mailFrom = config('domain_verifier.mail.from');
        $mailTo = $this->emailTo.'@'.$this->domainName;
        $mailSubject = config('domain_verifier.mail.subject');
        $mailView = config('domain_verifier.mail.view');
        $baseUrl = config('domain_verifier.base_url');

        $activationUrl = $baseUrl.'/domain-verify/activate/'.$this->activationToken;

        return $this
            ->from($mailFrom)
            ->to($mailTo)
            ->subject($mailSubject)
            ->view($mailView)
            ->with([
                'url' => $this->url,
                'domainName' => $this->domainName,
                'activationToken' => $this->activationToken,
                'activationUrl' => $activationUrl,
                'verifiable' => $this->verifiable,
            ]);
    }
}
