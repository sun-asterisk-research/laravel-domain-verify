<?php

namespace SunAsterisk\DomainVerifier\Models;

use Illuminate\Database\Eloquent\Model;

class DomainVerification extends Model
{
    protected $table = 'domain_verifications';

    protected $fillable = [
        'verifiable_id',
        'url',
        'status',
        'token',
        'email_sent_at',
        'verified_at',
    ];

    /**
     * Set verified domain
     *
     * @return DomainVerification
     */
    public function setVerified()
    {
        $this->update([
            'verified_at' => now(),
            'status' => 'verified',
        ]);

        return $this;
    }
}
