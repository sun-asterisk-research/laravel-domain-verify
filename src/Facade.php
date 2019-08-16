<?php
namespace SunAsterisk\DomainVerifier;

use Illuminate\Support\Facades\Facade as IlluminateFacade;
use SunAsterisk\DomainVerifier\Repositories\DomainVerification;

class Facade extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return DomainVerification::class;
    }
}
