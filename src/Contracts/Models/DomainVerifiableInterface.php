<?php

namespace SunAsterisk\DomainVerifier\Contracts\Models;

interface DomainVerifiableInterface
{
    /**
     * Get unique key of domain verifiable
     *
     * @return mixed
     */
    public function getKey();
}
