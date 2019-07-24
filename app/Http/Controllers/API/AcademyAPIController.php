<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAcademyAPIRequest;
use App\Http\Requests\API\UpdateAcademyAPIRequest;
use App\Models\Academy;
use App\Repositories\AcademyRepository;
use App\Repositories\AccountRepository;
use App\Repositories\InstructorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppBaseController;
use Response;

use App\Transformers\InstructorTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;


/**
 * Class AcademyController
 * @package App\Http\Controllers\API
 *
 * @OA\Response(
 *   response="Academy",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
 *        @OA\Property(
 *         property="data",
 *         type="object",
 *         allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/resource")},
 *         @OA\Property(
		property="attributes",
		type="array",
 *         @OA\Items(

 *         ref="#/components/schemas/Academy"
 *       )
 *       )
 *       )
 *     )
 *   )
 * ),
 * @OA\Response(
 *   response="Academies",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
 *        @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/resource")},

 *        @OA\Property(
		property="attributes",
		type="array",
 *         @OA\Items(
		ref="#/components/schemas/Academy")
 *       )
 *       )
 *       )

 *     )
 *   )
 * )
 */

class AcademyAPIController extends AppBaseController
{
    /** @var  AcademyRepository */
    private $academyRepository;

    public function __construct(AcademyRepository $academyRepo)
    {
        $this->academyRepository = $academyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *   path="/academies",
     *   summary="Get a listing of the Academies.",
     *   tags={"Academy"},
     *   @OA\Response(
     *     response=200,
     *     description="Get all Academies",
     *     ref="#/components/responses/Academies",
     *   )
     * )
     */

    public function index(Request $request)
    {
        $academies = $this->academyRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
                );

        return $this->sendResponse($academies->toArray(), 'Academies retrieved successfully');
    }

    /**
     * @param CreateAcademyAPIRequest $request
     * @return Response
     *
     * @OA\Post(
     *   path="/academies",
     *   summary="Store a newly created Academy in storage",
     *   tags={"Academy"},
     *   description="Store Academy",
     *   @OA\RequestBody(
     *     description="Academy that should be updated",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Academy"),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *   )
     * )
     */

    public function store(CreateAcademyAPIRequest $request)
    {
        $input = $request->all();

        $academies = $this->academyRepository->create($input);

        return $this->sendResponse($academies->toArray(), 'Academy saved successfully');
    }

    /**
     * @param string $id
     * @return Response
     *
     * @OA\Get(
     *   path="/academies/{id}",
     *   summary="Display the specified Academy",
     *   tags={"Academy"},
     *   description="Get Academy",
     *   @OA\Parameter(
     *     name="id",
     *     description="id of Academy",
     *     @OA\Schema(ref="#/components/schemas/Academy/properties/AcademyID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Academies",
     *   )
     * )
     */

    public function show($id)
    {
        /** @var Academy $academy */
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            return $this->sendError('Academy not found');
        }

        return $this->sendResponse($academy->toArray(), 'Academy retrieved successfully');
    }

    /**
     * @param string $id
     * @param UpdateAcademyAPIRequest $request
     * @return Response
     *
     * @OA\Patch(
     *   path="/academies/{id}",
     *   summary="Update the specified Academy in storage",
     *   tags={"Academy"},
     *   description="Update Academy",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="id of Academy that should be updated",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/Academy/properties/AcademyID"),
     *   ),
     *   @OA\RequestBody(
     *     description="Academy that should be updated",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/Academy")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/schemas/Academy"
     *   )
     * )
     */

    public function update($id, UpdateAcademyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Academy $academy */
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            return $this->sendError('Academy not found');
        }

        $academy = $this->academyRepository->update($input, $id);

        return $this->sendResponse($academy->toArray(), 'Academy updated successfully');
    }

    /**
     * @param string $id
     * @return Response
     *
     * @OA\Delete(
     *   path="/academies/{id}",
     *   summary="Remove the specified Academy from storage",
     *   tags={"Academy"},
     *   description="Delete Academy",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="id of Academy",
     *     @OA\Schema(ref="#/components/schemas/Academy/properties/AcademyID"),
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
        /** @var Academy $academy */
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            return $this->sendError('Academy not found');
        }

        $academy->delete();

        return $this->sendResponse($id, 'Academy deleted successfully');
    }

    /**
     * @param string $id
     * @return Response
     *
     * @OA\GET(
     *   path="/academies/{id}/instructors",
     *   summary="Get instructor accounts for an acadmey",
     *   tags={"Academy"},
     *   description="Get instructor accounts",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="Academy Code/ID",
     *     @OA\Schema(ref="#/components/schemas/Academy/properties/AcademyID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Instructors"
     *   )
     * )
     */
    public function showInstructors($id, Request $request)
    {
        $user = \Auth::user();
        $academy = $this->academyRepository->find($id);

        $this->instructorRepository = new InstructorRepository(app());

        $fields = ['FirstName', 'LastName'];
        //if the user is not an instructor then don't query the emails
        //because we shouldn't allow straight up email harvesting
        if($user->isApiAgent()) {
            $fields[] = 'Email';
        } else {
            $instructor  = $this->instructorRepository->find($user->AccountID);
            if ($instructor) {
                $academies = $instructor->academies()->get();
                if (in_array($id, $academies->pluck('AcademyID')->all())) {
                }
            }
        }

        $accountList = $this->instructorRepository->forAcademy(
            $id,
            [],
            $request->get('skip'),
            $request->get('limit') ? $request->get('limit') : 10,
            $fields
        );
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $resource = new Collection($accountList->all(), new InstructorTransformer);
        return response()->json((new Manager)->createData($resource)->toArray());
    }

    /**
     * @param String $id academyID 
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *   path="/academies/{id}/enroll",
     *   summary="Join an academy as a student",
     *   tags={"Academy"},
     *   description="Join an Academy",
     *   @OA\Parameter(
     *     name="id",
     *     description="id of Academy",
     *     @OA\Schema(ref="#/components/schemas/Academy/properties/AcademyID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *   )
     * )
     */
    public function enrollAcademy($id, Request $request)
    {
        $user = \Auth::user();
        $academy = $this->academyRepository->find($id);

        //This should check academy join preferences, but we don't
        //have that in the legacy DB


        //if the user is an API agent, they're not really an Account record
        //of the legacy DB, so don't do anything
        if($user->isApiAgent()) {
            return response()->json(['errors'=>['status'=>402]], 402);
        }

        try {
            DB::table('AcademyStudents')->insert([
                'AcademyID'=>trim($academy->AcademyID),
                'AccountID'=>$user->AccountID,
            ]);
        } catch (\Exception $e) {
            //unique key prevents duplicates
        }

        return response()->json([], 200);
    }

}
