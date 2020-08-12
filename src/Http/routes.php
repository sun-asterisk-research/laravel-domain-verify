<?php

use Illuminate\Support\Facades\Route;

Route::get('/domain-verify/html-file/{id}', [
    'uses' => 'SunAsterisk\DomainVerifier\Http\Controller\DomainVerifierController@getHtmlFile',
    'as' => 'domain_verify.get_html_file',
]);

Route::get('/domain-verify/activate/{token}', [
    'uses' => 'SunAsterisk\DomainVerifier\Http\Controller\DomainVerifierController@verify',
    'as' => 'domain_verify.verify',
]);
