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
            \ignore_user_abort(true);

            $awsAccessKey = env('AWS_ACCESS_KEY_ID'); // YOUR AWS ACCESS KEY
            $awsSecretKey = env('AWS_SECRET_ACCESS_KEY'); // YOUR AWS SECRET KEY
            $awsRegion    = env('AWS_DEFAULT_REGION');      // YOUR AWS BUCKET REGION
            $basePath     = env('AWS_BUCKET');
            $awsUrl       = env('AWS_URL');

            $s3Client = new S3Client([
                'version'     => 'latest',
                'region'      => 'us-east-1',
                'endpoint'    => 'https://nyc3.digitaloceanspaces.com',
                'debug'       => false,
                'credentials' => new Credentials($awsAccessKey, $awsSecretKey)
            ]);
            // Create a new Space
            //$s3Client->createBucket([
            //     'Bucket' => 'vos-videos',
            //]);
            //$spaces = $s3Client->listBuckets();

            $s3Client->registerStreamWrapper();
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
