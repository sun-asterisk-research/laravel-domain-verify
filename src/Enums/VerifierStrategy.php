<?php

namespace SunAsterisk\DomainVerifier\Enums;

class VerifierStrategy
{
    public const DNS_RECORD = 'dns-record';
    public const HTML_FILE = 'html-file';
    public const HTML_META = 'html-meta';
    public const SENDING_MAIL = 'sending-mail';

    public static function getAlls()
    {
        return collect([
            self::DNS_RECORD,
            self::HTML_FILE,
            self::HTML_META,
            self::SENDING_MAIL,
        ]);
    }
}
