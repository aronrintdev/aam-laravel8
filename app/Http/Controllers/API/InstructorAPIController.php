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

use App\Transformers\InstructorTransformer;
use App\Transformers\StudentTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
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
 *         ref="#/components/schemas/instructor"
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
 *         @OA\Items(ref="#/components/schemas/instructor")
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
 *         @OA\Items(ref="#/components/schemas/student")
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
     * @ OA\Get(
     *   path="/instructors",
     *   summary="Get a listing of the Instructors.",
     *   tags={"Instructor"},
     *   description="Get all Instructors",
     *   @ OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @ OA\Response(
     *     response=200,
     *     ref="#/components/responses/Instructors"
     *   )
     * )
     */

    public function index(Request $request)
    {
        $limit = $request->get('limit') ? (int)$request->get('limit') : 100;
        if ($limit > 500) {
            $limit = 500;
        }

       $fields = [
            'Instructors.InstructorID',
            'AccountID',
            'FirstName',
            'LastName',
            'Title',
            'HeadShot',
            'Biography',
            'Philosophy',
            'Accomplishments',
        ];


        $instructors = $this->instructorRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $limit,
                $fields
                );

        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $resource = new Collection($instructors, new InstructorTransformer);
        return response()->json((new Manager)->createData($resource)->toArray());

        return $this->sendResponse($instructors->toArray(), 'Instructors retrieved successfully');
    }

    /**
     * @param CreateInstructorAPIRequest $request
     * @return Response
     *
     * @ OA\Post(
     *   path="/instructors",
     *   summary="Store a newly created Instructor in storage",
     *   tags={"Instructor"},
     *   description="Store Instructor",
     *   @ OA\MediaType(
     *      mediaType="application/json"
     *   ),
     *   @ OA\RequestBody(
     *     description="Instructor that should be created",
     *     required=true,
     *     @ OA\MediaType(
     *       mediaType="application/json",
     *       @ OA\Schema(ref="#/components/schemas/instructor")
     *     )
     *   ),
     *   @ OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Instructor"
     *   )
     * )
     */

    public function store(CreateInstructorAPIRequest $request)
    {
        $input = $request->all();

        $instructor = $this->instructorRepository->create($input);

        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $resource = new Item($instructor, new InstructorTransformer);
        return response()->json((new Manager)->createData($resource)->toArray());
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
     *     @OA\Schema(ref="#/components/schemas/LegacyInstructor/properties/InstructorID"),
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

        $fields = [
            'Instructors.InstructorID',
            'AccountID',
            'FirstName',
            'LastName',
            'Title',
            'HeadShot',
            'Biography',
            'Philosophy',
            'Accomplishments',
        ];

        $user = \Auth::user();
        //if we are using the robot token to access, give back email as well
        if($user && $user->isApiAgent()) {
            $fields[] = 'Email';
        }


        /** @var Instructor $instructor */
        $instructor = $this->instructorRepository->find($id, $fields);

        if (empty($instructor)) {
            return $this->sendError('Instructor not found');
        }


        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $resource = new Item($instructor, new InstructorTransformer);
        return response()->json((new Manager)->createData($resource)->toArray());
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
     *     @OA\Schema(ref="#/components/schemas/LegacyInstructor/properties/InstructorID")
     *   ),
     *   @OA\RequestBody(
     *     description="Instructor that should be updated",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/instructor")
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
        $input = collect($request->all());

        /** @var Instructor $instructor */
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            return $this->sendError('Instructor not found');
        }

        //only update these fields
        $updatable = [
            'philo'       => 'Philosophy',
            'bio'         => 'Biography',
            'accolades'   => 'Accomplishments',
            'first_name'  => 'FirstName',
            'last_name'   => 'LastName',
            'title'       => 'Title',
            'profile_pic' => 'HeadShot',
            'email'       => 'Email',
        ];
        $keyed = $input->mapWithKeys(function($item, $index) use($updatable) {
            if (array_key_exists($index, $updatable)) {
                return [$updatable[$index] => $item];
            } else {
                return [$index => $item];
            }
        })->all();

        $this->instructorRepository->update($keyed, $id);

        $accountRepository = new AccountRepository(app());
        $accountRepository->update($keyed, $id);

        //reselect the instructor because it's joined off account table
        $fields = [
            'Instructors.InstructorID',
            'AccountID',
            'FirstName',
            'LastName',
            'Title',
            'HeadShot',
            'Biography',
            'Philosophy',
            'Accomplishments',
        ];

        $user = \Auth::user();
        //if we are using the robot token to access, give back email as well
        if($user && $user->isApiAgent()) {
            $fields[] = 'Email';
        }
        $instructor = $this->instructorRepository->find($id, $fields);

        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $resource = new Item($instructor, new InstructorTransformer);
        return response()->json((new Manager)->createData($resource)->toArray());
    }

    /**
     * @param int $id
     * @return Response
     *
     * @ OA\Delete(
     *   path="/instructors/{id}",
     *   summary="Remove the specified Instructor from storage",
     *   tags={"Instructor"},
     *   description="Delete Instructor",
     *   @ OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @ OA\Parameter(
     *     name="id",
     *     description="id of Instructor",
     *     @ OA\Schema(ref="#/components/schemas/LegacyInstructor/properties/InstructorID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @ OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @ OA\Schema(
     *       type="object",
     *       @ OA\Property(
     *           property="success",
     *           type="boolean"
     *       ),
     *       @ OA\Property(
     *           property="data",
     *           type="string"
     *       ),
     *       @ OA\Property(
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
     *     @OA\Schema(ref="#/components/schemas/LegacyInstructor/properties/InstructorID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Parameter(
     *     name="withAcademy",
     *     description="include students of active academies",
     *     @OA\Schema(
     *       type="boolean"
     *     ),
     *     required=false,
     *     in="query"
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
     *     @OA\Schema(ref="#/components/schemas/LegacyInstructor/properties/InstructorID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Parameter(
     *     name="withAcademy",
     *     description="include students of active academies",
     *     @OA\Schema(
     *       type="boolean"
     *     ),
     *     required=false,
     *     in="query"
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
        if (optional(\Auth::user())->AccountID != $id) {
            return response()->json(['error'=>'Unauthorized.'], 403);
        }
        $filterIds = $request->post('ids');
        if (!is_array($filterIds)) {
            $filterIds = array();
        }
        $withAcademyStudents = ($request->query('withAcademy') === 'true') ? true : false;

        /** @var Instructor $instructor */
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            return $this->sendError('Instructor not found');
        }
        $limit = $request->get('limit') ? (int)$request->get('limit') : 100;
        if ($limit > 500) {
            $limit = 500;
        }

        $accountList = $this->instructorRepository->students(
            $instructor->InstructorID,
            $withAcademyStudents,
            $filterIds,
            $request->get('skip'),
            $limit,
        );
        //get full total if more rows than limit were returned
        $total = $accountList->count();
        if ($total >= $limit) {
            $total = $this->instructorRepository->totalStudents(
                $instructor->InstructorID,
                $withAcademyStudents,
                $filterIds,
            );
        }

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

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *   path="/instructors/{id}/headshot",
     *   summary="Update the public headshot specified by the AccountID",
     *   tags={"Instructor"},
     *   description="Update Headshot",
     *   @OA\RequestBody(
     *     description="Upload images request body",
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         type="object",
     *           @OA\Property(
     *            property="headshot",
     *            type="string",
     *            format="binary",
     *          )
     *       )
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of Account",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/account/properties/id")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Instructor"
     *   )
     * )
     */
    public function headshot($id, Request $request)
    {
        $input = $request->all();

        $fields = [
            'Instructors.InstructorID',
            'AccountID',
            'FirstName',
            'LastName',
            'Title',
            'HeadShot',
            'Biography',
            'Philosophy',
            'Accomplishments',
        ];

        $instructor = $this->instructorRepository->find($id, $fields);

        if (empty($instructor)) {
            return $this->sendError('Account not found');
        }

        $account = \Auth::user();
        if ($account->AccountID != $instructor->InstructorID) {
            return $this->sendError('Not owner of account');
        }
        $hash = sha1($account->Email). '-hs-'.$account->AccountID;
        $filepath = 'academy/'.substr($hash, 0, 2).'/';
        $file = $request->file('headshot');
        if ($extension = $file->guessExtension()) {
            $hash .= '.'.$extension;
        }

        $q = \Storage::disk('do-vos-media')->put($filepath.$hash, (string)file_get_contents((string)$file));
        //$url = $file->storeAs($filepath, $hash, 'do-vos-media');
        $prefix = config('filesystems.disks.do-vos-media.root');

        $instructor = $this->instructorRepository->update([
          'HeadShot'=>'https://vos-media.nyc3.digitaloceanspaces.com/'.$prefix.$filepath.$hash,
        ], $instructor->InstructorID);

        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $resource = new Item($instructor, new InstructorTransformer);
        return response()->json((new Manager)->createData($resource)->toArray());
    }
}
