# sun-asterisk/laravel-domain-verify

Verify domain ownership for the Laravel application. We provide three ways to verify the domain ownership (like Google):

- [x] Via domain's DNS record
- [x] Via HTML tag
- [x] Via HTML file
- [x] Via Adminstrator's email address: `admin@domain.example`, `webmaster@domain.example`.

## Installation

First, install Domain Verifier via the Composer package manager:

```bash
# install this package:
composer require sun-asterisk/laravel-domain-verify

# create config/domain_verifier.php and:
php artisan vendor:publish --provider="SunAsterisk\DomainVerifier\DomainVerifierServiceProvider"

# migrate database:
php artisan migrate
```

## Usage

Integrate with your model.

```php
<?php

namespace App\Models;

// ...
use SunAsterisk\DomainVerifier\Contracts\Models\DomainVerifiable;
use SunAsterisk\DomainVerifier\Traits\DomainVerifiable as DomainVerifiableTrait;
use SunAsterisk\DomainVerifier\Models\DomainVerification;

class Website extends Model implements DomainVerifiable
{
    use DomainVerifiableTrait;

    //..
}
```

## Requirements

- Laravel `>= 5.6.0`
