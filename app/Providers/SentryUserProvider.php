<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SentryUserProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * We need this here and in the exceptions\handler.
     * This will run as early as possible to capture exceptions to laravel
     * but it will not get the real IP because the trusted proxy check doesn't
     * happen until middleware. 
     *
     * So, we will run this same code again as late as possible in the exception
     * handler.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->bound('sentry') && config('app.debug') == false) {
            //this is required to get a client and a layer in the sentry hub...
            //if there's no client, the configure scope just silently fails
            app('sentry')->getClient();
            //sentry people are django people, so they
            //don't get Laravel
            //the IP Address is not taken from Laravel / Symfony
            //after it has done the trusted proxy check, it's only
            //taken from  $_SERVER
            \Sentry\Laravel\Integration::configureScope(function (\Sentry\State\Scope $scope): void {
                $u = \Auth()->user();
                $scope->setUser([
                    'email'      => optional($u)->email,
                    'id'         => optional($u)->account_id,
                    'name'       => optional($u)->first_name. ' ' .optional($u)->last_name,
                    'ip_address' => Request()->ip(),
                ]);
            });
        }
    }
}
