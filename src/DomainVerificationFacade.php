<?php

namespace SunAsterisk\DomainVerifier;

use Illuminate\Support\Facades\Facade as IlluminateFacade;
use SunAsterisk\DomainVerifier\Repositories\DomainVerification as DomainVerify;

class DomainVerificationFacade extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return DomainVerify::class;
    }
}
