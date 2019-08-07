<?php

namespace SunAsterisk\DomainVerifier\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $table = 'domain_verification_codes';

    protected $fillable = [
        'verifiable_id',
        'site',
        'token',
        'status',
    ];
}
