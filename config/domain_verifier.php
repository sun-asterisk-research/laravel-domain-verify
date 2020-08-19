<?php

return [
    'verification_name' => env('DOMAIN_VERIFICATION_NAME', 'domain-verification'),
    'base_url' => env('DOMAIN_VERIFICATION_BASE_URL', 'http://localhost'),

    'mail' => [
        'from' => env('DOMAIN_VERIFY_MAIL_FROM', 'noreply@example.localhost'),
        'subject' => env('DOMAIN_VERIFY_MAIL_SUBJECT', 'Domain Verification'),
        'view' => env('DOMAIN_VERIFY_MAIL_VIEW', 'laravel-domain-verify::mail'),
    ],

    'page' => [
        'verification_succeeded' => env(
            'DOMAIN_VERIFY_VERIFICATION_SUCCEEDED_VIEW',
            'laravel-domain-verify::verification_succeeded'
        ),
        'verification_failed' => env(
            'DOMAIN_VERIFY_VERIFICATION_FAILED_VIEW',
            'laravel-domain-verify::verification_failed'
        ),
    ],
];
