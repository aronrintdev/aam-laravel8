<?php

namespace App\Providers;

use TusPhp\Tus\Server as TusServer;
use Illuminate\Support\ServiceProvider;

class TusServerProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tus-server', function ($app) {
            //\ignore_user_abort ( true );
            $fileCache = new \TusPhp\Cache\FileStore(
                storage_path('app/public/cache/'),
                '/tus.server.cache'
            );
            $server = new TusServer($fileCache);
            //$server = new TusServer('redis');

            $server
                ->setApiPath('/api201902/tus') // tus server endpoint.
                ->setUploadDir(storage_path('app/public/uploads')); // uploads dir.

            return $server;
        });
    }
}
