<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->bound('sentry') && config('app.debug') == false){
            \Sentry\configureScope(function (\Sentry\State\Scope $scope) {
                try {
                    $u = \Auth()->user();
                    $scope->setUser([
                        'email' => optional($u)->Email,
                        'id' => optional($u)->AccountID,
                        'ip_address' => Request()->ip(),
                    ]);
                } catch (\Exception $e) {
                    //what exception?
                }
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
