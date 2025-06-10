<?php

namespace Kavenegar\LaravelNotification;

use Kavenegar\KavenegarApi;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;

class KavenegarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->when(KavenegarChannel::class)
            ->needs(KavenegarApi::class)
            ->give(fn () => new KavenegarApi(config('services.kavenegar.key')));
    }

    public function boot(): void
    {
        Notification::extend('kavenegar', function ($app) {
            return new KavenegarChannel($app->make(KavenegarApi::class));
        });
    }
}
