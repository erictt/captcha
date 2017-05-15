reCAPTCHA
==========

## Installation

## Installation

Add the following line to the `require` section of `composer.json`:

```json
{
    "require": {
        "erictt/recaptcha": "dev-master"
    }
}
```

### Setup

1. Add ServiceProvider to the providers array in `app/config/app.php`.

```
Erictt\Recaptcha\RecaptchaServiceProvider::class,
```
and the following to `aliases`:
```
'Recaptcha' => Erictt\Recaptcha\Facades\Recaptcha::class,
```

2. Run `php artisan vendor:publish --provider="Erictt\Recaptcha\RecaptchaServiceProvider"`.

3. In `/config/recaptcha.php`, enter your reCAPTCHA public and private keys.

### Usage

##### Display reCAPTCHA

```php
{!! app('captcha')->display(); !!}
```

With custom attributes and language support:

```
{!! app('captcha')->display($attributes = [], $lang = null); !!}
```

##### Validation

Add `'g-recaptcha-response' => 'required|captcha'` to rules array.

```php

$validate = Validator::make(Input::all(), [
	'g-recaptcha-response' => 'required|captcha'
]);

```
