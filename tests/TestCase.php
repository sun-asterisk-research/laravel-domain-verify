<?php

namespace SunAsterisk\DomainVerifier\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Config;
use SunAsterisk\DomainVerifier\DomainVerifierServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use DatabaseMigrations;

    public const VERIFICATION_NAME = 'domain-verification';

    public function setUp(): void
    {
        parent::setUp();

        Config::set('domain_verifier.verification_name', self::VERIFICATION_NAME);
        Config::set('app.key', 'test_app_key');
    }

    protected function getPackageProviders($app)
    {
        return [
            DomainVerifierServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
    }
}
