<?php

namespace Erictt\Recaptcha;

use Illuminate\Support\ServiceProvider;

class RecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $app = $this->app;

        $this->bootConfig();

        $app['validator']->extend('recaptcha', function ($attribute, $value) use ($app) {
            return $app['recaptcha']->verifyResponse($value, $app['request']->getClientIp());
        });

        if ($app->bound('form')) {
            $app['form']->macro('recaptcha', function ($attributes = []) use ($app) {
                return $app['recaptcha']->display($attributes, $app->getLocale());
            });
        }
    }

    /**
     * Booting configure.
     */
    protected function bootConfig()
    {
        $path = __DIR__.'/config/recaptcha.php';

        $this->mergeConfigFrom($path, 'recaptcha');

        if (function_exists('config_path')) {
            $this->publishes([$path => config_path('recaptcha.php')]);
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('recaptcha', function ($app) {
            return new Recaptcha(
                $app['config']['recaptcha.secret'],
                $app['config']['recaptcha.sitekey']
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['captcha'];
    }
}
