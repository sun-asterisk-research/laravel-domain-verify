<?php

namespace SunAsterisk\DomainVerifier\Tests\Strategies;

use Mockery;
use SunAsterisk\DomainVerifier\Results\VerifyResult;
use SunAsterisk\DomainVerifier\Strategies\HTMLMeta;

class HTMLMetaTest extends StrategyTestCase
{
    protected $verifier;
    protected $url;
    protected $token;

    public function setUp(): void
    {
        parent::setUp();

        $this->url = 'https://domain.local';

        $this->token = (new HTMLMeta())->getToken($this->url, $this->verifiable);
    }

    public function testItCanCheckValidToken()
    {
        $result = $this->verifyWith($this->token);
        $this->assertInstanceOf(VerifyResult::class, $result);
        $this->assertTrue($result->isVerified());
        $this->assertEquals('verified', $result->getStatus());
    }

    public function testItCanCheckInvalidToken()
    {
        $result = $this->verifyWith('some wrong token');
        $this->assertFalse($result->isVerified());
        $this->assertEquals('pending', $result->getStatus());
    }

    protected function verifyWith(string $token): VerifyResult
    {
        $this->verifier = Mockery::mock(HTMLMeta::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods()
            ->allows(['getMetaTags' => [self::VERIFICATION_NAME => $token]]);

        return $this->verifier->verify($this->url, $this->verifiable);
    }
}
