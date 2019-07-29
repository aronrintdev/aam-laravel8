<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInstructorAPIRequest;
use App\Http\Requests\API\UpdateInstructorAPIRequest;
use App\Models\Instructor;
use App\Repositories\InstructorRepository;
use App\Repositories\AccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

use App\Transformers\StudentTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;


/**
 * Class InstructorController
 * @package App\Http\Controllers\API
 *
 * @OA\Response(
 *   response="Instructor",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
 *        @OA\Property(
 *         property="data",
 *         type="object",
 *         ref="#/components/schemas/Instructor"
 *       )
 *     )
 *   )
 * ),
 * @OA\Response(
 *   response="Instructors",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
 *        @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Instructor")
 *       )
 *     )
 *   )
 * ),
 * @OA\Response(
 *   response="Students",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
 *        @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Student")
 *       )
 *     )
 *   )
 * )
 */

class InstructorAPIController extends AppBaseController
{
    /** @var  InstructorRepository */
    private $instructorRepository;

    public function __construct(InstructorRepository $instructorRepo)
    {
        $this->instructorRepository = $instructorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *   path="/instructors",
     *   summary="Get a listing of the Instructors.",
     *   tags={"Instructor"},
     *   description="Get all Instructors",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     ref="#/components/responses/Instructors"
     *   )
     * )
     */

    public function index(Request $request)
    {
        $instructors = $this->instructorRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
                );

        return $this->sendResponse($instructors->toArray(), 'Instructors retrieved successfully');
    }

    /**
     * @param CreateInstructorAPIRequest $request
     * @return Response
     *
     * @OA\Post(
     *   path="/instructors",
     *   summary="Store a newly created Instructor in storage",
     *   tags={"Instructor"},
     *   description="Store Instructor",
     *   @OA\MediaType(
     *      mediaType="application/json"
     *   ),
     *   @OA\RequestBody(
     *     description="Instructor that should be created",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/Instructor")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Instructor"
     *   )
     * )
     */

    public function store(CreateInstructorAPIRequest $request)
    {
        $input = $request->all();

        $instructors = $this->instructorRepository->create($input);

        return $this->sendResponse($instructors->toArray(), 'Instructor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *   path="/instructors/{id}",
     *   summary="Display the specified Instructor",
     *   tags={"Instructor"},
     *   description="Get Instructor",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="id of Instructor",
     *     @OA\Schema(ref="#/components/schemas/InstructorRaw/properties/InstructorID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Instructor"
     *   )
     * )
     */

    public function show($id)
    {
        /** @var Instructor $instructor */
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            return $this->sendError('Instructor not found');
        }

        return $this->sendResponse($instructor->toArray(), 'Instructor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInstructorAPIRequest $request
     * @return Response
     *
     * @OA\Patch(
     *   path="/instructors/{id}",
     *   summary="Update the specified Instructor in storage",
     *   tags={"Instructor"},
     *   description="Update Instructor",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="id of Instructor that should be updated",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/InstructorRaw/properties/InstructorID")
     *   ),
     *   @OA\RequestBody(
     *     description="Instructor that should be updated",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/Instructor")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Instructor"
     *   )
     * )
     */

    public function update($id, UpdateInstructorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Instructor $instructor */
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            return $this->sendError('Instructor not found');
        }

        $instructor = $this->instructorRepository->update($input, $id);

        return $this->sendResponse($instructor->toArray(), 'Instructor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *   path="/instructors/{id}",
     *   summary="Remove the specified Instructor from storage",
     *   tags={"Instructor"},
     *   description="Delete Instructor",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="id of Instructor",
     *     @OA\Schema(ref="#/components/schemas/InstructorRaw/properties/InstructorID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\Schema(
     *       type="object",
     *       @OA\Property(
     *           property="success",
     *           type="boolean"
     *       ),
     *       @OA\Property(
     *           property="data",
     *           type="string"
     *       ),
     *       @OA\Property(
     *           property="message",
     *           type="string"
     *       )
     *     )
     *   )
     * )
     */
    public function destroy($id)
    {
        /** @var Instructor $instructor */
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            return $this->sendError('Instructor not found');
        }

        $instructor->delete();

        return $this->sendResponse($id, 'Instructor deleted successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\POST(
     *   path="/instructors/{id}/students",
     *   summary="Get student accounts for an instructor",
     *   tags={"Instructor"},
     *   description="Get student accounts",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="id of Instructor",
     *     @OA\Schema(ref="#/components/schemas/InstructorRaw/properties/InstructorID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\RequestBody(
     *     description="list of student IDs to include in response",
     *     required=false,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *        @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(type="integer")
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Students"
     *   )
     * )
     * @OA\GET(
     *   path="/instructors/{id}/students",
     *   summary="Get student accounts for an instructor",
     *   tags={"Instructor"},
     *   description="Get student accounts",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="id of Instructor",
     *     @OA\Schema(ref="#/components/schemas/InstructorRaw/properties/InstructorID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Students"
     *   )
     * )
     */
    public function showStudents($id, Request $request)
    {
        if (\Auth::user()->AccountID != $id) {
            return response()->json(['error'=>'Unauthorized.'], 403);
        }
        $input = $request->all();
        /** @var Instructor $instructor */
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            return $this->sendError('Instructor not found');
        }

        /*
        $this->accountRepository = new AccountRepository(app());
        $accountList = $this->accountRepository->all(
            ['AccountID' => $input],
            $request->get('skip'),
            $request->get('limit') ? $request->get('limit') : 10,
        );
        $total = $this->accountRepository->total(
            ['AccountID' => $input],
        );
         */
        $accountList = $this->instructorRepository->students(
            $instructor->InstructorID,
            $request->get('skip'),
            $request->get('limit') ? $request->get('limit') : 10,
        );
        $total = $this->instructorRepository->totalStudents(
            $instructor->InstructorID
        );

        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $resource = (new Collection($accountList->all(), new StudentTransformer))->setMetaValue('total', $total);
        return response()->json((new Manager)->createData($resource)->toArray());
    }

    /*
    public function index(Request $request)
    {
        $accounts = $this->accountRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit') ? $request->get('limit') : 10
                );

        return $this->sendJsonApiResponse('account', 'AccountID', $accounts->toArray());
    }
     */
}
