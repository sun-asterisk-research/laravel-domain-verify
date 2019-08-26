<?php

namespace SunAsterisk\DomainVerifier\Http\Controller;

use Illuminate\Routing\Controller as BaseController;
use SunAsterisk\DomainVerifier\DomainVerificationFacade;

class DomainVerifierController extends BaseController
{
    function verify($token){
        DomainVerificationFacade::setVerifiedByToken($token);
        $route =  config('domain_verifier.activation_route');
        return route($route);
    }

    function activated(){
        return view("domain-verifier::activated");
    }
}
