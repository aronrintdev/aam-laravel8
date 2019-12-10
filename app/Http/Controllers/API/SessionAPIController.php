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

        $auth = auth();
        $token = $auth->parseToken();

        if (!$auth->authenticate()) { // Check user not found. Check token has expired.
            \Log::info('no auth in refresh token');
            throw new UnauthorizedHttpException('jwt-auth', 'User not found');
        } 

        $auth->customClaims(['accid' => $id]);
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
}
