<?php

namespace SunAsterisk\DomainVerifier\Repositories;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\ConnectionInterface;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Repositories\DomainVerificationInterface;
use SunAsterisk\DomainVerifier\Supports\URL;
use SunAsterisk\DomainVerifier\Models\DomainVerification as DomainVerificationModel;
use Illuminate\Support\Str;

class DomainVerification implements DomainVerificationInterface
{
    /** @var \Illuminate\Database\ConnectionInterface */
    protected $connection;

    /** @var string */
    protected $table;

    /** @var \Illuminate\Contracts\Hashing\Hasher */
    protected $hasher;

    /** @var string */
    protected $hashKey;

    /**
     * @param  \Illuminate\Database\ConnectionInterface  $connection
     * @param  string  $table
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @param  string  $hashKey
     */
    public function __construct(ConnectionInterface $connection, string $table, Hasher $hasher, string $hashKey)
    {
        $this->connection = $connection;
        $this->table = $table;
        $this->hasher = $hasher;
        $this->hashKey = $hashKey;
    }

    public function firstOrCreate(string $url, DomainVerifiableInterface $verifiable): DomainVerificationModel
    {
        return DomainVerificationModel::firstOrCreate(
            [
                'verifiable_type' => get_class($verifiable),
                'verifiable_id' => $verifiable->getKey(),
                'url' => $url,
            ],
            [
                'status' => 'pending',
                'token' => $this->generateToken(),
                'activation_token' => $this->generateToken(),
            ]
        );
    }

    /** @inheritDoc */
    public function findByActivationToken(string $activationToken): ?DomainVerificationModel
    {
        return DomainVerificationModel::where('activation_token', $activationToken)
            ->first();
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
