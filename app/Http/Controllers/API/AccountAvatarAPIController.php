<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountAvatarAPIRequest;
use App\Http\Requests\API\UpdateAccountAvatarAPIRequest;
use App\Models\AccountAvatar;
use App\Repositories\AccountAvatarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

use App\Transformers\AccountAvatarTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;


/**
 * Class AccountAvatarController
 * @package App\Http\Controllers\API
 *
 * @OA\Response(
 *   response="AccountAvatar",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="/jsonapi.org-schema.json#/components/schemas/success")},
 *        @OA\Property(
 *         property="data",
 *         type="object",
 *         ref="#/components/schemas/account_avatar"
 *       )
 *     )
 *   )
 * ),
 * @OA\Response(
 *   response="AccountAvatars",
 *   description="successful operation",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="/jsonapi.org-schema.json#/components/schemas/success")},
 *        @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/AccountAvatar")
 *       )
 *     )
 *   )
 * )
 */
class AccountAvatarAPIController extends AppBaseController
{
    /** @var  AccountAvatarRepository */
    private $accountAvatarRepository;

    public function __construct(AccountAvatarRepository $accountAvatarRepo)
    {
        $this->accountAvatarRepository = $accountAvatarRepo;
    }


    /**
     * @param CreateAccountAvatarAPIRequest $request
     * @return Response
     *
     * @OA\Post(
     *   path="/avatar/{id}",
     *   operationId="uploadAvatar",
     *   summary="Upload an avatar image",
     *   tags={"Avatar"},
     *   @OA\RequestBody(
     *     description="Upload images request body",
     *     @OA\MediaType(
     *       mediaType="application/octet-stream",
     *       @OA\Schema(
     *         type="string",
     *         format="binary"
     *       )
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="ID of Account",
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/AccountAvatar"
     *   )
     * )
     */
    public function store($id, CreateAccountAvatarAPIRequest $request)
    {
//        $input = $request->all();

//        $file = $request->file('avatar');
        $file = $request->getContent();

        $accountAvatar = $this->accountAvatarRepository->create([
          'AccountID'=>(int)$id,
          'AvatarURL'=>'http://test.test/foo.png',
        ]);

        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $resource = new Item($accountAvatar, new AccountAvatarTransformer);
        return response()->json((new Manager)->createData($resource)->toArray());
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *   path="/avatar/{account_id}",
     *   summary="Fetch an avatar by AccountID",
     *   tags={"Avatar"},
     *   description="Get Account Avatar",
     *   @OA\MediaType(
     *     mediaType="application/json",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="ID of Account",
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/AccountAvatar"
     *   )
     * )
     */
    public function show($id)
    {
        /** @var AccountAvatar $accountAvatar */
        $accountAvatar = $this->accountAvatarRepository->findByAccountID($id);

        if (empty($accountAvatar)) {
            return $this->sendError('Account Avatar not found');
        }

        return $this->sendResponse($accountAvatar->toArray(), 'Account Avatar retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAccountAvatarAPIRequest $request
     * @return Response
     *
     * @OA\Patch(
     *   path="/avatar/{account_id}",
     *   summary="Update the avatar specified by the AccountID",
     *   tags={"Avatar"},
     *   description="Update Avatar",
     *   @OA\MediaType(
     *     mediaType="application/json",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of Account",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ref="#/components/responses/AccountAvatar"
     *   )
     * )
     */
    public function update($id, UpdateAccountAvatarAPIRequest $request)
    {
        $input = $request->all();

        /** @var AccountAvatar $accountAvatar */
        $accountAvatar = $this->accountAvatarRepository->findByAccountID($id);

        if (empty($accountAvatar)) {
            return $this->sendError('Account Avatar not found');
        }

        $accountAvatar = $this->accountAvatarRepository->update($input, $id);

        return $this->sendResponse($accountAvatar->toArray(), 'AccountAvatar updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *   path="/avatar/{account_id}",
     *   summary="Remove the avatar specified by the AccountID",
     *   tags={"Avatar"},
     *   description="Delete AccountAvatar",
     *   @OA\MediaType(
     *     mediaType="application/json",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="ID of Account",
     *     @OA\Schema(ref="#/components/schemas/Account/properties/AccountID"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="success",
     *     @OA\Schema(ref="/jsonapi.org-schema.json#/components/schemas/success"),
     *   )
     * )
     */
    public function destroy($id)
    {
        /** @var AccountAvatar $accountAvatar */
        $accountAvatar = $this->accountAvatarRepository->find($id);

        if (empty($accountAvatar)) {
            return $this->sendError('Account Avatar not found');
        }

        $accountAvatar->delete();

        return $this->sendResponse($id, 'Account Avatar deleted successfully');
    }
}
