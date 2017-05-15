reCAPTCHA
==========

* Forked from [anhskohbo/no-captcha](https://github.com/anhskohbo/no-captcha)
* This repo's purpose is to seperate script and dom which is very useful in vuejs.
* Still working on it.

## Installation

Add the following line to the `require` section of `composer.json`:

```json
{
    "require": {
        "erictt/recaptcha": "0.1.1"
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

3. In `/config/recaptcha.php`, enter your reCAPTCHA sitekey and secret keys.

### Usage

##### Display reCAPTCHA

```php
{!! Recaptcha->display(['dom', 'script']); !!}
```

or seperately
```php
{!! Recaptcha->display(['dom']); !!}
{!! Recaptcha->display(['script']); !!}
```

##### Validation

Add `'g-recaptcha-response' => 'required|captcha'` to rules array.

```php

$validate = Validator::make(Input::all(), [
	'g-recaptcha-response' => 'required|captcha'
]);

```
