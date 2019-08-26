<?php

namespace SunAsterisk\DomainVerifier\Strategies;

use Illuminate\Support\Facades\Mail as IlluminateMail;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Strategies\StrategyInterface;
use SunAsterisk\DomainVerifier\DomainVerificationFacade as DomainVerification;
use SunAsterisk\DomainVerifier\Supports\URL;

class Mail implements StrategyInterface
{
    /**
     * Verfiy domain ownership via administrator mail
     *
     * @param string $url
     * @param DomainVerifiableInterface $domainVerifiable
     * @return bool
     */
    public function verify(string $url, DomainVerifiableInterface $domainVerifiable)
    {
        $token = DomainVerification::getTokenFor($url, $domainVerifiable)->token;
        $url = URL::getDomainName($url);
        $view = config('domain_verifier.mail.view');
        $subject = config('domain_verifier.mail.subject');
        $data = config('domain_verifier.mail.data');
        if (!isset($data['token'])){
            $data['token'] = $token;
        }

        IlluminateMail::send($view, $data, function ($message) use ($url, $subject) {
            $message
                ->to('admin@'.$url, "Admin")
                ->to('webmaster@'.$url, "Admin")
                ->subject($subject);
        });
    }
}
