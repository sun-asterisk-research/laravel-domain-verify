<?php

namespace SunAsterisk\DomainVerifier;

use Illuminate\Support\Facades\Facade;
use SunAsterisk\DomainVerifier\Factories\VerifierFactory;

class VerifierFactoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return VerifierFactory::class;
    }
}
