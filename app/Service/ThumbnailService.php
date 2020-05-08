<?php
namespace App\Service;

use GuzzleHttp\Promise\Promise as GuzzlePromise;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Str;

class ThumbnailService {

    /**
     * @return Mixed Guzzle Response with binary data in stream or false
     */
    public function processVideoUrl($url) {
        $guzzleResponse = $this->sendRequest($url);
        if($guzzleResponse == null) {
            //error
            return false;
        }
        return $guzzleResponse;
    }

    public function sendRequest($url) {
        $client  = new GuzzleClient();
        $url = config('aam.video_thumbnail_service')."/index.php?url=$url&s=3";

        //$request = $client->createRequest('GET', $url);
        $request = new \GuzzleHttp\Psr7\Request('GET', $url, []);
        $promise = $client->sendAsync($request, [
            'debug'   => false,
            'future'  => true,
        ]);

        $x = $promise->then(
            function($response) {
                return $response;
            },
            function($e) {
                if ($e instanceof BadResponseException) {
                    Log::warn('Thumbnail process exception', ['exception'=>$e]);
                }
                if ($e instanceof ConnectException) {
                    Log::alert('Thumbnail connect exception', ['exception'=>$e]);
                }
            }
        );
        return $promise->wait();
    }
}
