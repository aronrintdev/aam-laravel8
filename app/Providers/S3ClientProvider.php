<?php

namespace App\Providers;

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;
use TusPhp\Tus\Server as TusServer;
use Illuminate\Support\ServiceProvider;

class S3ClientProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('s3-client', function ($app) {
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

            $s3Client->registerStreamWrapper();
            return $s3Client;
        });
    }
}
