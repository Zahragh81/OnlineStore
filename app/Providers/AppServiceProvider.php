<?php

namespace App\Providers;

use App\Services\PaymentGatewayService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PaymentGatewayService::class, function ($app){
            return new PaymentGatewayService();
        });
    }


    public function boot(): void
    {
        //
    }
}
