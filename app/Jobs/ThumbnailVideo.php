<?php

namespace App\Jobs;

use App\Service\ThumbnailService;
use App\Repositories\SwingRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ThumbnailVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $destinationFile;
    public $videoId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($videoId)
    {
        $this->videoId = $videoId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $repo = \app()->make(SwingRepository::class);
        $video = $repo->find($this->videoId);

        if (!$video->exists()) {
            throw new \InvalidArgumentException();
        }
        $uriParts = parse_url($video->VideoPath);
        $destinationFile = substr($uriParts['path'], 0, strrpos($uriParts['path'], '.')) . '.jpg';

        $guzzleResponse = (new ThumbnailService())->processVideoUrl($video->VideoPath);
        if ($guzzleResponse == null) {
            throw new \Exception('Failed to process thumbnail for video: ' . $this->videoId);
        }
        $bytesTransferred = $this->copyInputStreamToS3($guzzleResponse, $destinationFile);
    }

    public function copyInputStreamToS3($guzzleResponse, $destinationFile) {
        $bucket = 'vos-media';
        //making the object from the Provider calls "registerStreamWrapper"
        //so even if $s3Client is not used here, it is required to be make()'d
        $s3Client = \app()->make('s3-client');

        //64-bit arch has hardcoded internal buffer of 8k
        //stream_copy_to_stream has flexible buffer limit
        $chunksize =  8192 * 24;

        $input = $guzzleResponse->getBody()->detach();
        $output = @fopen('s3://'.$bucket.$destinationFile, 'wb', false, stream_context_create([
            's3' => [
                'ACL' => 'public-read',
            ]])
        );
        $bytes = 0;
        while (!feof($input)) {
            $bytes += stream_copy_to_stream($input, $output, $chunksize);
        }
        @fclose($oputput);
        @fclose($input);
        return $bytes;
    }
}
