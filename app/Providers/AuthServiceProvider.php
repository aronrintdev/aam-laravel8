<?php

namespace App\Providers;
#use Laravel\Passport\Passport;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\DatabaseUserProvider;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\TokenGuard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Passport::routes();

        Auth::provider('v1users', function ($app, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
            return new V1UserProvider(\DB::connection('sqlsrv'));
            //return new V1UserProvider($app->make('riak.connection'));
        });

        Auth::extend('access_token', function ($app, $name, array $config) {
            // automatically build the DI, put it as reference
            //$userProvider = app()->makeWith(DatabaseUserProvider::class, ['table'=>'users', 'conn'=>\DB::connection('backendmysql')]);
            $userProvider = app()->makeWith(EloquentUserProvider::class, ['table'=>'users', 'model'=>'App\User', 'conn'=>\DB::connection('backendmysql')]);
            $request = app('request');
            return new TokenGuard($userProvider, $request, 'api_token', 'api_token', false);
        });
    }
}
