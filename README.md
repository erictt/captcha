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
        "erictt/recaptcha": "*"
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

* or seperately
```php
{!! Recaptcha->display(['dom']); !!}
{!! Recaptcha->display(['script']); !!}
```

* Complete HTML codes:
```html
<div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
    <label for="g-recaptcha-response" class="col-md-4 control-label"></label>

    <div class="col-md-6">
        {!! Recaptcha::display(['dom']) !!}
        @if ($errors->has('g-recaptcha-response'))
            <span class="help-block">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            </span>
        @endif
    </div>
</div>
```

##### Validation

Add `'g-recaptcha-response' => 'recaptcha'` to rules array.

PS: I don't think we need `require` rule for this.

```php

$validate = Validator::make(Input::all(), [
	'g-recaptcha-response' => 'recaptcha'
]);

```


