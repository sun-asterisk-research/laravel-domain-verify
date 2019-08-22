<?php

namespace SunAsterisk\DomainVerifier\Models;

use Illuminate\Database\Eloquent\Model;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;

class DomainVerification extends Model implements DomainVerifiableInterface
{
    protected $table = 'domain_verifications';

    protected $fillable = [
        'verifiable_id',
        'url',
        'token',
    ];
}
