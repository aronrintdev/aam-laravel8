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
        $videoPrefix = '';
        if (substr($item->AnalysisPath, 0, 4) !== 'http') {
            $videoPrefix = 'https://v1sports.com/SwingStore/';
        }
        $thumbUrl = str_replace( ['.mp4', '.webm'], '.jpg', $item->AnalysisPath);
        if (substr($thumbUrl, 0, 4) !== 'http') {
            $thumbUrl = 'https://v1sports.com/SwingStore/'.$thumbUrl;
        }

        return [
            'id'         => (int) $item->SwingID,
            'type'       => 'video',
            'attributes' => [
                'video_url'        => $videoPrefix.$item->AnalysisPath,
                'thumb_url'        => $thumbUrl,
                'source_video_url' => $videoPrefix.$item->VideoPath,
                'source_video_id'  => $item->SwingID,
                'date_uploaded'    => $item->DateAnalyzed,
                'instructor_id'    => $item->InstructorID,
                'account_id'       => $item->AccountID,
            ]
        ];
    }
}
