<?php

namespace SunAsterisk\DomainVerifier\Tests\Strategies;

use Mockery;
use SunAsterisk\DomainVerifier\Tests\TestCase;
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiableInterface;

class StrategyTestCase extends TestCase
{
    protected $verifiable;

    public function setUp(): void
    {
        parent::setUp();

        $this->verifiable = Mockery::mock(DomainVerifiableInterface::class)
            ->makePartial()->allows()
            ->getKey()
            ->andReturns('1')
            ->getMock();
    }
}
