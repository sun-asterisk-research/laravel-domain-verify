<?php

namespace SunAsterisk\DomainVerifier\Contracts\Models;

interface DomainVerifiable
{
    /**
     * Get unique key of domain verifiable
     *
     */
    public function getKey();

    /**
     * Get all the domain verification records
     *
     */
    public function domainVerifications();
}
