<?php

namespace SunAsterisk\DomainVerifier\Repositories;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\ConnectionInterface;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;
use SunAsterisk\DomainVerifier\Contracts\Repositories\DomainVerificationInterface;
use SunAsterisk\DomainVerifier\Supports\URL;
use SunAsterisk\DomainVerifier\Models\DomainVerification as DomainVerificationModel;

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
                'verifiable_id' => $verifiable->getKey(),
                'url' => $url,
            ],
            [
                'status' => 'pending',
                'token' => $this->hasher->make($this->generateToken()),
            ]
        );
    }

    /** @inheritDoc */
    public function getTokenFor(string $url, DomainVerifiableInterface $verifiable)
    {
        return $this->getTable()
            ->where('url', URL::normalize($url))
            ->where('verifiable_id', $verifiable->getKey())
            ->first();
    }

    /** @inheritDoc */
    public function getByToken(string $token)
    {
        return $this->getTable()
            ->where('token', $token)
            ->first();
    }

    /** @inheritDoc */
    public function setVerified(string $url, DomainVerifiableInterface $verifiable): DomainVerificationModel
    {
        $record = DomainVerificationModel::where('verifiable_id', $verifiable->getKey())
            ->where('url', $url)
            ->first();

        $record->update([
                'verified_at' => now(),
                'status' => 'verified',
            ]);

        return $record;
    }

    /** @inheritDoc */
    public function setVerifiedByToken(string $token)
    {
        $this->getTable()
            ->where('token', $token)
            ->update(['verified_at' => now()]);
    }

    /**
     * Delete existing verifications
     *
     * @param  \SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface  $verifiable
     * @param  string  $url
     * @return void
     */
    protected function deleteExisting(DomainVerifiableInterface $verifiable, string $url)
    {
        $this->getTable()
            ->where('verifiable_id', $verifiable->getKey())
            ->where('url', $url)
            ->delete();
    }

    /**
     * Get table query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function getTable()
    {
        return $this->connection->table($this->table);
    }

    /**
     * Create a new randoom token
     *
     * @return string
     */
    protected function generateToken()
    {
        return hash_hmac('sha256', str_random(48), $this->hashKey);
    }
}
