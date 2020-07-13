<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountAvatarAPIRequest;
use App\Http\Requests\API\UpdateAccountAvatarAPIRequest;
use App\Http\Requests\API\DeleteAccountAvatarAPIRequest;
use App\Models\AccountAvatar;
use App\Repositories\AccountRepository;
use App\Repositories\AccountAvatarRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\AppBaseController;
use Response;

use App\Transformers\AccountAvatarTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;
use Laravolt\Avatar\Facade as Avatar;


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
 *        @OA\Property(
 *         property="data",
 *         type="object",
 *         ref="#/components/schemas/avatar"
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
 *        @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/avatar")
 *       )
 *     )
 *   )
 * )
 */
class AccountAvatarAPIController extends AppBaseController
{
    /** @var  AccountAvatarRepository */
    private $accountAvatarRepository;

    public function __construct(AccountAvatarRepository $accountAvatarRepo, AccountRepository $accountRepo)
    {
        $this->accountAvatarRepository = $accountAvatarRepo;
        $this->accountRepository = $accountRepo;
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
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         type="object",
     *           @OA\Property(
     *            property="avatar",
     *            type="string",
     *            format="binary",
     *          )
     *       )
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="ID of Account",
     *     @OA\Schema(ref="#/components/schemas/account/properties/id"),
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
    public function store(CreateAccountAvatarAPIRequest $request, $id)
    {
        $file = $request->file('avatar');
        $account = $this->accountRepository->find($id);
        if (!$account) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        $hash = sha1($account->Email). '-'.$id;
        $filepath = 'profile/'.substr($hash, 0, 2);
        if ($extension = $file->guessExtension()) {
            $hash .= '.'.$extension;
        }

        $url = $file->storeAs($filepath, $hash, 'do-vos-media');
        $prefix = config('filesystems.disks.do-vos-media.root');

        try {
            $accountAvatar = $this->accountAvatarRepository->create([
                'AccountID'=>(int)$id,
                'AvatarURL'=>sprintf('%s/%s',
                    'https://vos-media.nyc3.cdn.digitaloceanspaces.com',
                    $prefix.$url
                ),
            ]);
        } catch (\Exception $e) {
            return response()->json(['errors'=>[['title'=>'Internal server error', 'status'=>500, 'detail'=>$e->getMessage()]]], 500);
        }

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
     *   path="/avatar/{id}",
     *   summary="Fetch an avatar by AccountID",
     *   tags={"Avatar"},
     *   description="Get Account Avatar",
     *   @OA\MediaType(
     *     mediaType="application/json",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="ID of Account",
     *     @OA\Schema(ref="#/components/schemas/account/properties/id"),
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
            try {
                $account = $this->accountRepository->find($id);
                $accountAvatar = new AccountAvatar([
                  'AccountID'=>(int)$account->AccountID,
                  'AvatarURL'=>route('api.avatar.default.image', (int)$account->AccountID),
                ]);

            } catch (\Exception $e) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }
        }

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
     *   path="/avatar/{id}/defaultimage.png",
     *   summary="Fetch an avatar by AccountID",
     *   tags={"Avatar"},
     *   description="Render default avatar",
     *   @OA\Parameter(
     *     name="id",
     *     description="ID of Account",
     *     @OA\Schema(ref="#/components/schemas/account/properties/id"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     @OA\MediaType(
     *       mediaType="image/png",
     *     ),
     *     description="Image binary",
     *     @OA\Schema(
     *       type="object",
     *       @OA\Property(
     *         property="avatar",
     *         type="string",
     *         format="binary",
     *       )
     *     )
     *   )
     * )
     */
    public function defaultImage($id)
    {
        /** @var AccountAvatar $accountAvatar */
        $accountAvatar = $this->accountAvatarRepository->findByAccountID($id);

        try {
            $account = $this->accountRepository->find($id);
            $avatarImage = $this->createNewImage($account);
            if (!$accountAvatar) {
                $accountAvatar = $this->createNewAvatar($account, $avatarImage);
            }
        } catch (\Exception $e) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        //cache for 1 month in seconds
        return response((string)$avatarImage->stream('png'))
            ->header('Content-Type', 'image/png')
            ->header('Last-Modified', 'Tue, 1 Jan 2019 21:24:22 GMT')
            ->header('Cache-Control', 'max-age=2630000, public');
    }

    /**
     * @param int $id
     * @param UpdateAccountAvatarAPIRequest $request
     * @return Response
     *
     * @OA\Post(
     *   path="/avatar/{id}/update",
     *   summary="Update the avatar specified by the AccountID",
     *   tags={"Avatar"},
     *   description="Update Avatar",
     *
     *   @OA\RequestBody(
     *     description="Upload images request body",
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         type="object",
     *           @OA\Property(
     *            property="avatar",
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

        $account = \Auth::user();
        $hash = sha1($account->Email). '-'.$account->AccountID;
        $filepath = 'profile/'.substr($hash, 0, 2);
        $file = $request->file('avatar');
        if ($extension = $file->guessExtension()) {
            $hash .= '.'.$extension;
        }

        $q = \Storage::disk('do-vos-media')->putFileAs($filepath, $file, $hash, 'public');
        //$url = $file->storeAs($filepath, $hash, 'do-vos-media');
        $prefix = config('filesystems.disks.do-vos-media.root');

        $accountAvatar = $this->accountAvatarRepository->update([
          'AccountID'=>(int)$account->AccountID,
          'AvatarURL'=>'https://vos-media.nyc3.digitaloceanspaces.com/'.$prefix.$filepath.$hash,
        ], $accountAvatar->AccountAvatarID);

        //$accountAvatar = $this->accountAvatarRepository->update($input, $id);
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $resource = new Item($accountAvatar, new AccountAvatarTransformer);
        return response()->json((new Manager)->createData($resource)->toArray());
    }

    /**
     * @param int $id
     * @param DeleteAccountAvatarAPIRequest $request
     * @return Response
     *
     * @OA\Delete(
     *   path="/avatar/{id}",
     *   summary="Remove the avatar specified by the AccountID",
     *   tags={"Avatar"},
     *   description="Delete AccountAvatar",
     *   @OA\MediaType(
     *     mediaType="application/json",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="ID of Account",
     *     @OA\Schema(ref="#/components/schemas/account/properties/id"),
     *     required=true,
     *     in="path"
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="success",
     *     @OA\Schema(ref="/jsonapi.org-schema.json#/definitions/success"),
     *   )
     * )
     */
    public function destroy($id, DeleteAccountAvatarAPIRequest $request)
    {
        /** @var AccountAvatar $accountAvatar */
        $accountAvatar = $this->accountAvatarRepository->findByAccountID($id);

        if (empty($accountAvatar)) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        $prefix = config('filesystems.disks.do-vos-media.root');
        $url    = parse_url($accountAvatar['AvatarURL']);
        $filepath = str_replace($prefix, '', $url['path']);

        $result = \Storage::disk('do-vos-media')->delete($filepath);
        if ($result) {
            $accountAvatar->delete();
        }
        return $this->sendResponse($id, 'Account Avatar deleted successfully');
    }

    public function createNewImage($account) {
        $io = Avatar::create($account->FirstName.' '.$account->LastName)->getImageObject();
        $io->resize(128, 128);
        return $io;
    }

    public function createNewAvatar($account, $io) {

        $hash = sha1($account->Email). '-'.$account->AccountID;
        $filepath = 'profile/'.substr($hash, 0, 2).'/';
        $hash .= '.png';

        \Storage::disk('do-vos-media')->put($filepath.$hash, (string)$io->stream('png'));
        //$url = $file->storeAs($filepath, $hash, 'do-vos-media');
        $prefix = config('filesystems.disks.do-vos-media.root');

        $accountAvatar = $this->accountAvatarRepository->create([
          'AccountID'=>(int)$account->AccountID,
          'AvatarURL'=>'https://vos-media.nyc3.digitaloceanspaces.com/'.$prefix.$filepath.$hash,
        ]);
        return $accountAvatar;
    }
}
