<?php

namespace SunAsterisk\DomainVerifier\Models;

use Illuminate\Database\Eloquent\Model;

class DomainVerification extends Model
{
    protected $table = 'domain_verifications';

    protected $fillable = [
        'verifiable_type',
        'verifiable_id',
        'url',
        'status',
        'token',
        'activation_token',
        'email_sent_at',
        'verified_at',
    ];

    /**
     * Get the owning verifiable model
     *
     */
    public function verifiable()
    {
        return $this->morphTo();
    }

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

    /**
     * Unverify domain
     *
     * @return DomainVerification
     */
    public function setNotVerified()
    {
        $this->update([
            'verified_at' => null,
            'status' => 'pending',
        ]);

        return $this;
    }
}
