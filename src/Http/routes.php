<?php

use Illuminate\Support\Facades\Route;

Route::get('/domain-verify/{token}', [
    'uses' => 'SunAsterisk\DomainVerifier\Http\Controller\DomainVerifierController@verify',
    'as' => 'domain_verify.verify',
]);

Route::get('/domain-verify/activated', [
    'uses' => 'SunAsterisk\DomainVerifier\Http\Controller\DomainVerifierController@activated',
    'as' => 'domain-verify.activated',
]);
