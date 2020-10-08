<?php
namespace App\Transformers;

use App\Models\Swing;
use League\Fractal;

/**
 * @OA\Schema(
 *   schema="lessonvideo",
 *   required={""},
 *   @OA\Property(
 *     property="id",
 *     description="SwingID (not reliable as an ID)",
 *     example="123",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="type",
 *     description="data type (video)",
 *     default="video",
 *     example="video",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="attributes",
 *     type="object",
 *       @OA\Property(
 *         property="video_url",
 *         description="",
 *         example="https://vos-media.nyc3.digitaloceanspaces.com/profile/ab/abcdefg-123.mp4",
 *         type="string",
 *         format="uri"
 *       ),
 *       @OA\Property(
 *         property="thumb_url",
 *         description="",
 *         example="https://vos-media.nyc3.digitaloceanspaces.com/profile/ab/abcdefg-123.jpg",
 *         type="string",
 *         format="uri"
 *       ),
 *       @OA\Property(
 *         property="title",
 *         description="",
 *         example="iPhone Video",
 *         type="string",
 *       ),
 *       @OA\Property(
 *         property="source_video_url",
 *         description="",
 *         example="https://vos-media.nyc3.digitaloceanspaces.com/profile/ab/abcdefg-123.mp4",
 *         type="string",
 *         format="uri"
 *       ),
 *       @OA\Property(
 *         property="date_uploaded",
 *         type="string",
 *         format="date-time"
 *       ),
 *       @OA\Property(
 *         property="instructor_id",
 *         type="integer"
 *       ),
 *       @OA\Property(
 *         property="account_id",
 *         type="integer"
 *       ),
 *   )
 * )
 */
class SwingAnalysisTransformer extends Fractal\TransformerAbstract
{
    public function transform(Swing $item)
    {
        $analysisPrefix = '';
        $videoPrefix = '';
        if (substr($item->AnalysisPath, 0, 4) !== 'http') {
            $analysisPrefix = 'https://v1sports.com/SwingStore/';
        }
        if (substr($item->VideoPath, 0, 4) !== 'http') {
            $videoPrefix = 'https://v1sports.com/SwingStore/';
        }

        $thumbUrl = str_replace( ['.mp4', '.webm', '.avi'], '.jpg', $item->AnalysisPath);
        if (substr($thumbUrl, 0, 4) !== 'http') {
            $thumbUrl = 'https://v1sports.com/SwingStore/'.$thumbUrl;
        }

        //TZ: Dates are stored in OS local timezones in MSSQL (probably Amercia/New_York)
        //DateUploaded is one column for the source video.
        //The analysis was uploaded on DateAnalyzed date
        return [
            'id'         => (int) $item->SwingID,
            'type'       => 'video',
            'attributes' => [
                'video_url'        => $analysisPrefix.$item->AnalysisPath,
                'thumb_url'        => $thumbUrl,
                'title'            => trim($item->Description),
                'source_video_url' => $videoPrefix.$item->VideoPath,
                'source_video_id'  => $item->SwingID,
                'date_uploaded'    => $item->DateAnalyzed,
                'date_accepted'    => $item->DateAccepted,
                'instructor_id'    => $item->InstructorID,
                'status_id'        => $item->SwingStatusID,
                'account_id'       => $item->AccountID,
            ]
        ];
    }
}
