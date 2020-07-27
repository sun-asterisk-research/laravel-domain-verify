<?php

return [
    'verification_name' => env('DOMAIN_VERIFICATION_NAME', 'domain-verification'),

    'mail' => [
        'from' => env('DOMAIN_VERIFY_MAIL_FROM', 'noreply@example.localhost'),
        'subject' => env('DOMAIN_VERIFY_MAIL_SUBJECT', 'Domain Verification'),
        'view' => env('DOMAIN_VERIFY_MAIL_VIEW', 'laravel-domain-verify::mail'),
    ],

    'route' => [
        'verification_succeeded' => env(
            'DOMAIN_VERIFY_VERIFICATION_SUCCEEDED_ROUTE',
            'domain_verify.verification_succeeded'
        ),
        'verification_failed' => env(
            'DOMAIN_VERIFY_VERIFICATION_FAILED_ROUTE',
            'domain_verify.verification_failed'
        ),
    ],
];
