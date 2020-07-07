<?php

return [
    // Used to find token:
    'verification_name' => env('DOMAIN_VERIFICATION_NAME', 'domain-verification'),

    'mail' => [
        'view' => env('DOMAIN_VERIFY_MAIL_VIEW', 'domain-verifier::mail'),
        'subject' => env('DOMAIN_VERIFY_MAIL_SUBJECT', 'Domain Verify Acttivation'),
        'data' => env('DOMAIN_VERIFY_MAIL_DATA'),
    ],

    'activation_route' => env('DOMAIN_VERIFY_ACTIVATION_ROUTE', 'domain-verify.activated'),
];
