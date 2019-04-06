<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountAPIRequest;
use App\Http\Requests\API\UpdateAccountAPIRequest;
use App\Models\Account;
use App\Repositories\AccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

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
                $request->get('limit')
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
}
