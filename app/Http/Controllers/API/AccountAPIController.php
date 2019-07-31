<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountAPIRequest;
use App\Http\Requests\API\UpdateAccountAPIRequest;
use App\Models\Account;
use App\Repositories\AccountRepository;
use App\Repositories\AcademyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;

/**
 * Class AccountController
 * @package App\Http\Controllers\API
 *
 * @OA\Response(
 *   response="Account",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
 *        @OA\Property(
 *         property="data",
 *         ref="#/components/schemas/Account"
 *       )
 *     )
 *   )
 * ),
 * @OA\Response(
 *   response="Accounts",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
 *        @OA\Property(
 *         property="data",
 *         type="array",
 *            @OA\Items(
 *              ref="#/components/schemas/Account"
 *            )
 *       )
 *     )
 *   )
 * )
 */

class AccountAPIController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *   path="/accounts",
     *   summary="Get a listing of the Accounts.",
     *   tags={"Account"},
     *   description="Get all Accounts",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     ref="#/components/responses/Accounts"
     *   )
     * )
     */

    public function index(Request $request)
    {
        $accounts = $this->accountRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit') ? $request->get('limit') : 10
                );

        return $this->sendJsonApiResponse('account', 'AccountID', $accounts->toArray());
    }

    /**
     * @param CreateAccountAPIRequest $request
     * @return Response
     *
     * @OA\Post(
     *   path="/accounts",
     *   summary="Store a newly created Account in storage",
     *   tags={"Account"},
     *   description="Store Account",
     *   @OA\MediaType(
     *      mediaType="application/json"
     *   ),
     *   @OA\RequestBody(
     *     description="Account that should be updated",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/Account")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Account"
     *   )
     * )
     */

    public function store(CreateAccountAPIRequest $request)
    {
        $input = $request->all();

        $accounts = $this->accountRepository->create($input);

        return $this->sendResponse($accounts->toArray(), 'Account saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *   path="/accounts/{id}",
     *   summary="Display the specified Account",
     *   tags={"Account"},
     *   description="Get Account",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="id of Account",
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Account"
     *   )
     * )
     */

    public function show($id)
    {
        /** @var Account $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        return $this->sendJsonApiResponse('account', 'AccountID', $account->toArray());
        return $this->sendResponse($account->toArray(), 'Account retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAccountAPIRequest $request
     * @return Response
     *
     * @OA\Patch(
     *   path="/accounts/{id}",
     *   summary="Update the specified Account in storage",
     *   tags={"Account"},
     *   description="Update Account",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="id of Account that should be updated",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID")
     *   ),
     *   @OA\RequestBody(
     *     description="Account that should be updated",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/Account")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Account"
     *   )
     * )
     */

    public function update($id, UpdateAccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var Account $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        $account = $this->accountRepository->update($input, $id);

        return $this->sendResponse($account->toArray(), 'Account updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *   path="/accounts/{id}",
     *   summary="Remove the specified Account from storage",
     *   tags={"Account"},
     *   description="Delete Account",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="id of Account",
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID"),
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
        /** @var Account $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        $account->delete();

        return $this->sendResponse($id, 'Account deleted successfully');
    }

    /**
     * only for backend authenticated clients
     */
    public function search(Request $request)
    {
        $searchParams = $request->except(['skip', 'limit']);
        if (empty($searchParams)) {
            throw new \Exception();
        }
        $searchParams['Deleted'] =false;

        $accounts = $this->accountRepository->all(
                $searchParams,
                $request->get('skip'),
                $request->get('limit') ? $request->get('limit') : 10
                );

        return $this->sendJsonApiResponse('account', 'AccountID', $accounts->toArray());
    }

    /**
     * only for backend authenticated clients
     */
    public function updatePassword(Request $request)
    {
        $updateParams = $request->except(['hmac']);
        if (empty($updateParams)) {
            throw new \Exception();
        }
        if (hash_hmac('sha256', json_encode($updateParams), env('JWT_SECRET')) != $request->input('hmac')) {
            throw new \Exception();
        }

        $this->performPasswordUpdate($updateParams['email'], $updateParams['password']);
    }

    protected function performPasswordUpdate($email, $password) {

        $query = $this->accountRepository->makeModel()->newQuery();

        $query->where('Email', $email);
        $account =  $query->get(['AccountID'])->first();
            $newSalt = substr(base64_encode(random_bytes(16)), 0, 16);
            $newSalt= 'IpoMQuv7g4aWgRd9';
            $newPassword = hash('sha256', $newSalt. hash('sha256', $password . $newSalt));

            $this->accountRepository->update([
                'PasswordSalt'=>$newSalt,
                'PasswordHash'=>$newPassword,
            ], $account->AccountID);
            /*
            $account->PasswordSalt = $newSalt;
            $account->PasswordHash = $newPassword;
            $account->save();
             */

        /*
        $accounts = $this->accountRepository->all(
                $updateParams,
                $request->get('skip'),
                $request->get('limit') ? $request->get('limit') : 10
                );

        return $this->sendJsonApiResponse('account', 'AccountID', $accounts->toArray());
         */
    }

    /**
     * @param int $user_id
     * @return Response
     *
     * @OA\Get(
     *   path="/accounts/{user_id}/academies",
     *   summary="Find academies linked to this Account",
     *   tags={"Account"},
     *   description="get academies linked to this account",
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="user_id",
     *     description="id of Account",
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/Academies"
     *   )
     * )
     */
    public function showAcademies($id)
    {
        if (\Auth::user()->AccountID !== $id) {
            return $this->sendError('Account not found');
        }

        $academyRepository = new AcademyRepository(app());

        /** @var Account $account */
        $academyList = $academyRepository->findByStudentId($id);

        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $resource = new Collection($academyList->toArray(), [$this, 'academyRecordTranslate'], 'academy');

        return response()->json((new Manager)->createData($resource)->toArray());
    }

    public function academyRecordTranslate(array $record) {
        return [
            'type'          => 'academy',
            'id'            => trim($record['AcademyID']),
            'attributes'    => [
                'name'          => $record['Name'],
                'code'          => $record['AcademyID'],
                'color-base'    => $record['BaseColor'],
                'color-bg'      => $record['BGColor'],
                'logo'          => $record['Logo'],
                'logo-login'    => $record['LogInGraphic'],
                'text-banner'   => $record['BannerText'],
            ],
        ];
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *   path="/accounts/{id}/follow/{instructorId}",
     *   summary="Follow an instructor",
     *   tags={"Account"},
     *   description="Create a connection to an instructor",
     *   @OA\MediaType(
     *      mediaType="application/json"
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="id of user Account",
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Parameter(
     *     name="instructorId",
     *     description="id of instructor Account",
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *   )
     * )
     */

    public function follow(Request $request, $id, $instructorId)
    {
        $user = \Auth::user();
        $account = $this->accountRepository->find($id);
        if ($user->AccountID != $id) {
            //check if instructor is instructor
            //TODO: only allow instructor adding student if
            //student is already in academy

            if ($user->AccountID != $instructorId) {
                return response()->json(['errors'=>['status'=>403]], 403);
            }
        }
        \DB::table('InstructorStudents')->insert([
            'InstructorID'  => $instructorId,
            'AccountID'     => $id,
            'StudentCharge' => 0,
        ]);

        return $this->sendResponse([], 'Account saved successfully');
    }
}
