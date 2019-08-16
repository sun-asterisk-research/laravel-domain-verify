<?php

namespace SunAsterisk\DomainVerifier\Models;

use Illuminate\Database\Eloquent\Model;

class DomainVerification extends Model
{
    protected $table = 'domain_verifications';

    protected $fillable = [
        'verifiable_id',
        'url',
        'token',
    ];
}
