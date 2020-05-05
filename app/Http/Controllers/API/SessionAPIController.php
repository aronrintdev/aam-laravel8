<?php

namespace App\Http\Controllers\API;

use App\Repositories\AcademyRepository;
use App\Repositories\InstructorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\UnauthorizedException;
use App\Http\Controllers\AppBaseController;
use Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class SessionAPIController {

    /**
     * @param string $id
     * @return Response
     *
     * @OA\POST(
     *   path="/session/{id}/switch",
     *   summary="Change the active academy in your session (for instructors)",
     *   tags={"session"},
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
     *  @OA\Response(
     *     response=200,
	 *     description="successful operation",
	 *     @OA\MediaType(
	 *       mediaType="application/json",
	 *       @OA\Schema(
     *       )
     *     )
     *   )
     * )
     */
    public function switchAcademy($id, Request $request)
    {
        $academyRepository = app()->make('App\Repositories\AcademyRepository');
        $academy = $academyRepository->find($id);
        if (!$academy) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }
        $user = \Auth::user();

        $instructorRepository = app()->make('App\Repositories\InstructorRepository');
        $instructor = $instructorRepository->find($user->AccountID);
        $matchingAcademy = $instructor->academies->filter(function($item) use($id) {
            return strtolower(trim($item->AcademyID)) === strtolower(trim($id));
        });
        if ($matchingAcademy->count() < 1) {
            throw new AuthorizationException('User does not belong to the chosen academy.', 403);
        }
        $matchingAcademy = $matchingAcademy->first();

        $auth = auth();
        $token = $auth->parseToken();

        if (!$auth->authenticate()) { // Check user not found. Check token has expired.
            \Log::info('no auth in refresh token');
            throw new UnauthorizedHttpException('jwt-auth', 'User not found');
        }

        $newClaims = array_merge($user->getJWTCustomClaims(), [
            'accid' => $id,
        ]);
        $auth->customClaims(
            $newClaims
        );
        $newtoken = $auth->refresh(false, true);

        //refresh doesn't update JWT internals, so we
        //do surgery here on the base64 blob
        $parts = explode('.', $newtoken);
        $newpayload = json_decode(base64_decode($parts[1]), true);
        $exp = $newpayload['exp'] - time();

        return response()->json([
            'access_token' => $newtoken,
            'token_type' => 'bearer',
            'expires_in' => $exp
        ])
        ->withCookie( cookie('token', $newtoken, $exp));
    }

    /**
     * @param string $id
     * @return Response
     *
     * @OA\POST(
     *   path="/session/check",
     *   summary="Check the validity of the JWT token",
     *   tags={"session"},
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *  @OA\Response(
     *     response=200,
	 *     description="valid session",
	 *     @OA\MediaType(
	 *       mediaType="application/json",
	 *       @OA\Schema(
     *       )
     *     )
     *   ),
     *  @OA\Response(
     *     response=401,
	 *     description="invalid token",
	 *     @OA\MediaType(
	 *       mediaType="application/json",
	 *       @OA\Schema(
     *       )
     *     )
     *   )
     * )
     */
    public function checkJwt(Request $request)
    {
        $user = \Auth::user();
        $auth = auth();
        $token = $auth->parseToken();

        if (!$auth->authenticate()) { // Check user not found. Check token has expired.
            throw new UnauthorizedHttpException('jwt-auth', 'User not found');
        }

        try {
            $payload = $token->getPayload();
            $expires = $payload->getClaims()->getByClaimName('exp');
            $exp = $expires->getValue() - time();

            return response()->json([
                'access_token' => $token->getToken()->get(),
                'token_type' => 'bearer',
                'expires_in' => $exp
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            $errors = [['status'=>401, 'source'=>'token', 'title'=>'Invalid Token', 'detail'=>$e->getMessage()]];
            return response()->json(['errors'=> $errors ], 401);
        }
    }
}
