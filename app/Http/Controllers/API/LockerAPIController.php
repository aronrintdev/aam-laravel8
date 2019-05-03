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
     *   tags={"Swing", "Locker"},
     *   description="Get all videos",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     ref="#/components/responses/Swings"
     *   )
     * )
     */

    public function index(Request $request)
    {
        $user = $request->user();
        $limit = $request->get('limit') ? intval($request->get('limit')) : 20;

        $swings = $this->swingRepository->all(
                ['AccountID'=>$user->AccountID],
                $request->get('skip'),
                $limit
                );

		$resource = new Collection($swings->toArray(), function(array $swing) {
			return [
				'id'      => (int) $swing['SwingID'],
				'title'   => $swing['Description'],
				'video_url'    => 'https://v1sports.com/SwingStore/'.$swing['VideoPath'],
				'thumb_url'    => str_replace('.mp4', '.jpg', 'https://v1sports.com/SwingStore/'.$swing['VideoPath']),
                //'thumb_url'    => 'https://v1sports.com/SwingStore/190424231844IP9M2449503.jpg',
				'date_uploaded' => $swing['DateUploaded'],
			];
		});

		return response()->json((new Manager)->createData($resource)->toArray());
//        return $this->sendResponse($swings->toArray(), 'Videos retrieved successfully');
    }
}
