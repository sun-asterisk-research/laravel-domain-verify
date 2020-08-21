<?php

namespace SunAsterisk\DomainVerifier\Repositories;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Str;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable;
use SunAsterisk\DomainVerifier\Contracts\Repositories\VerificationRepository;
use SunAsterisk\DomainVerifier\Models\DomainVerification as DomainVerificationModel;

class DomainVerification implements VerificationRepository
{
    /** @var \Illuminate\Database\ConnectionInterface */
    protected $connection;

    /** @var string */
    protected $table;

    /** @var \Illuminate\Contracts\Hashing\Hasher */
    protected $hasher;

    /** @var string */
    protected $hashKey;

    public function __construct(ConnectionInterface $connection, string $table, Hasher $hasher, string $hashKey)
    {
        $this->connection = $connection;
        $this->table = $table;
        $this->hasher = $hasher;
        $this->hashKey = $hashKey;
    }

    /**
     * Undocumented function
     *
     * @param  string $url
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable $verifiable
     * @return \SunAsterisk\DomainVerifier\Models\DomainVerification
     */
    public function firstOrCreate(string $url, DomainVerifiable $verifiable): DomainVerificationModel
    {
        return $verifiable->domainVerifications()->firstOrCreate(
            ['url' => $url],
            [
                'status' => 'pending',
                'token' => $this->generateToken(),
                'activation_token' => $this->generateToken(),
            ]
        );
    }

    public function findByActivationToken(string $activationToken): ?DomainVerificationModel
    {
        return DomainVerificationModel::where('activation_token', $activationToken)->first();
    }

    /**
     * Create a new randoom token
     *
     * @return string
     */
    protected function generateToken()
    {
        return hash_hmac('sha256', Str::random(48), $this->hashKey);
    }
}
