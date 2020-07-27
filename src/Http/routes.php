<?php

use Illuminate\Support\Facades\Route;

Route::get('/domain-verify/verification_succeeded', [
    'uses' => 'SunAsterisk\DomainVerifier\Http\Controller\DomainVerifierController@verificationSucceeded',
    'as' => 'domain_verify.verification_succeeded',
]);

Route::get('/domain-verify/verification_failed', [
    'uses' => 'SunAsterisk\DomainVerifier\Http\Controller\DomainVerifierController@verificationFailed',
    'as' => 'domain_verify.verification_failed',
]);

Route::get('/domain-verify/{token}', [
    'uses' => 'SunAsterisk\DomainVerifier\Http\Controller\DomainVerifierController@verify',
    'as' => 'domain_verify.verify',
]);
