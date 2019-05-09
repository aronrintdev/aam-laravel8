<?php

namespace App\Http\Controllers\API;

//use App\Http\Requests\API\CreateInstructorAPIRequest;
//use App\Http\Requests\API\UpdateInstructorAPIRequest;
use App\Models\Swing;
use App\Repositories\SwingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;


/**
 * Class LockerController
 * @package App\Http\Controllers\API
 *
 * @OA\Response(
 *   response="Locker",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
 *
 *        @OA\Property(
 *         property="data",
 *         type="object",
 *         ref="#/components/schemas/Swing"
 *       )
 *     )
 *   )
 * ),
 * @OA\Response(
 *   response="Swings",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
 *        @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Swing")
 *       )
 *     )
 *   )
 * )
 */

class LockerAPIController extends AppBaseController
{
    /** @var  SwingRepository */
    private $swingRepository;

    public function __construct(SwingRepository $swingRepo)
    {
        $this->swingRepository = $swingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *   path="/locker",
     *   summary="Get a listing of your Videos.",
     *   description="Get all your videos",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="List of all of videos connected to the logged in account which are not deleted",
     *     @OA\MediaType(
     *     mediaType="application/json",
     *
     *     @OA\Schema(
     *      allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
     *      @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/swing_record")
     *       )
     *       )
     *       )
     *     )
     *   )
     * )
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $limit = $request->get('limit') ? intval($request->get('limit')) : 20;

        $swings = $this->swingRepository->all(
                ['AccountID'=>$user->AccountID, 'Deleted'=>false],
                $request->get('skip'),
                $limit
                );

        $resource = new Collection($swings->toArray(), [$this, 'swingRecordTranslate']);

        return response()->json((new Manager)->createData($resource)->toArray());
        //return $this->sendResponse($swings->toArray(), 'Videos retrieved successfully');
    }

    /**
     * @OA\Schema(
     *   schema="swing_record",
     *   required={""},
     *   @OA\Property(
     *     property="id",
     *     description="Swing ID",
     *     type="integer",
     *          format="int32"
     *   ),
     *   @OA\Property(
     *     property="title",
     *     description="title or description",
     *     type="string"
     *   ),
     *   @OA\Property(
     *     property="date_uploaded",
     *     description="Date video was uploaded",
     *     type="string"
     *   ),
     *   @OA\Property(
     *     property="thumb_url",
     *     description="URL of thumbnail picture",
     *     type="string"
     *   ),
     *   @OA\Property(
     *     property="video_url",
     *     description="URL of video file",
     *     type="string"
     *   ),
     *   @OA\Property(
     *     property="vimeo_id",
     *     description="ID of video on Vimeo",
     *     type="string"
     *   ),
     *   @OA\Property(
     *     property="status_id",
     *     description="SwingStatusID",
     *     type="integer",
     *          format="int32"
     *   ),
     * )
     */
    public function swingRecordTranslate(array $swing) {
            return [
                'id'      => (int) $swing['SwingID'],
                'title'   => $swing['Description'],
                'video_url'    => 'https://v1sports.com/SwingStore/'.$swing['VideoPath'],
                'thumb_url'    => str_replace('.mp4', '.jpg', 'https://v1sports.com/SwingStore/'.$swing['VideoPath']),
                'vimeo_id'     => $swing['VimeoID'],
                'status_id'    => $swing['SwingStatusID'],
                //'thumb_url'    => 'https://v1sports.com/SwingStore/190424231844IP9M2449503.jpg',
                'date_uploaded' => $swing['DateUploaded'],
            ];
    }
}
