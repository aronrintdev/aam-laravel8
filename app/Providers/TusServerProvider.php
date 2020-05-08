<?php

namespace App\Providers;

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;
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
            //\ignore_user_abort(true);

            $s3Client = $this->app->make('s3-client');

            //\ignore_user_abort ( true );
            $fileCache = new \TusPhp\Cache\FileStore(
                storage_path('app/public/cache/'),
                '/tus.server.cache'
            );
            $server = new TusServer('redis');
            //$server = new TusServer($fileCache);
            //$server = new TusServer('redis');

            $server
                ->setApiPath('/api201902/tus') // tus server endpoint.
                ->setUploadDir('s3://vos-videos/test/swings'); // uploads dir.

            return $server;
        });
    }
}
