<?php

namespace SunAsterisk\DomainVerifier\Http\Controller;

use Illuminate\Routing\Controller;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;
use SunAsterisk\DomainVerifier\VerifierFactoryFacade as VerifierFactory;

class DomainVerifierController extends Controller
{
    public function verify($token)
    {
        $verifier = VerifierFactory::strategy('sending-mail');
        try {
            $result = $verifier->verifyByActivationToken($token);

            if ($result->isVerified()) {
                $route = config('domain_verifier.route.verification_succeeded');
                return redirect()->route($route);
            } else {
                $route = config('domain_verifier.route.verification_failed');
                return redirect()->route($route);
            }
        } catch (\Exception $exception) {
            $route = config('domain_verifier.route.verification_failed');
            return redirect()->route($route);
        }
    }

    public function verificationSucceeded()
    {
        return view('laravel-domain-verify::verification_succeeded');
    }

    public function verificationFailed()
    {
        return view('laravel-domain-verify::verification_failed');
    }
}
