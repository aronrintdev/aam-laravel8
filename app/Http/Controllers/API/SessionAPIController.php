<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Repositories\AcademyRepository;
use App\Repositories\InstructorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\UnauthorizedException;
use Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use JWTAuth;

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

    /**
     * @param string $id
     * @return Response
     *
     * @OA\POST(
     *   path="/session/refresh",
     *   summary="Process a refresh_token and return a new access_token and new refresh_token",
     *   tags={"session"},
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\RequestBody(
     *     description="RefreshToken in json format",
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *         @OA\Property(
     *           property="refresh_token",
     *           type="string",
     *         )
     *     )
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
    /**
     * User needs both access_token that is not total garbage (can be expired)
     * and a refresh token that is not revoked or expired.
     */
    public function refresh(Request $request)
    {
        $jwtManager = JWTAuth::manager();
        $jwtParsedToken   = JWTAuth::parseToken();
        $refreshToken = $request->input('refresh_token');
        if (!$refreshToken) {
            throw new UnauthorizedHttpException('jwt-auth', 'No refresh token');
        }
        try {
            if (!$jwtParsedToken->authenticate()) { // Check user not found. Check token has expired.
                //\Log::info('no auth in refresh token');
                throw new UnauthorizedHttpException('jwt-auth', 'User not found');
            }

            $payload = $jwtManager->getPayloadFactory()->buildClaimsCollection()->toPlainArray();
            //if exp is less than 30 min in the future
            if (time() > ($payload['exp']-(60*30))) {
                \Log::info('payload expires in 30 minutes...', [
                    'expiration'=>($payload['exp']-(60*30)),
                    'time' => time(),
                ]);
                throw new TokenExpiredException();
            }
        } catch (TokenExpiredException $t) {
            //whether token is expired or not, continue with
            //refresh
        }

        $tokenResults = \DB::table('jwt_refresh_tokens')->where([
            'refresh_token' => $request->input('refresh_token'),
            'revoked'       => 0
        ])->get();

        if ($tokenResults->count() < 1) {
            throw new UnauthorizedHttpException('jwt-auth', 'Token not found or revoked');
        }
        $foundToken = $tokenResults[0];
        $expiresDate = \Carbon\Carbon::parse($foundToken->expires);

        if ($expiresDate <= \Carbon\Carbon::now()) {
            throw new UnauthorizedHttpException('jwt-auth', 'Token expired');
        }

        $ua = $request->header('User-Agent');
        if (empty($ua)) {
            $ua = 'web';
        }

        $payload = $jwtManager->getPayloadFactory()->buildClaimsCollection()->toPlainArray();
        try {
            //this is required to set the internal ->token pointer in auth $this->auth->getToken();
            JWTAuth::getToken(); 
            //make new token
            $newtoken = JWTAuth::refresh();
            \DB::beginTransaction();
            //revoke existing token
            \DB::table('jwt_refresh_tokens')
                ->where([
                    'refresh_token' => $foundToken->refresh_token,
                    'revoked'       => 0
                ])->update([
                    'revoked'    => '1',
                    'revoked_on' => \Carbon\Carbon::now(),
                ]);
            //create and store new token
            $refreshToken = $this->generateUniqueIdentifier();
            $result = \DB::table('jwt_refresh_tokens')->insert([
                'refresh_token' => $refreshToken,
                'user_agent'    => substr($request->get('device_name', $ua), 0, 255),
                'user_id'       => $foundToken->user_id,
                'expires'       => \Carbon\Carbon::now()->addMonths(6),
                'revoked'       => 0,
            ]);
            \DB::commit();

            $expires = config('jwt.ttl') * 60;
            //time is unix timestmp, no ms, no tz
            $exp = $payload['exp'] - time();
            return response()->json([
                'access_token'  => $newtoken,
                'token_type'    => 'bearer',
                'expires_in'    => $exp,
                'refresh_token' => $refreshToken,
            ])
            ->withCookie( cookie('token', $newtoken, $expires, '/', null, false, false) );
        } catch (JWTException $e) {
            \Log::error('failed to refresh', ['exception'=>$e]);
            throw new UnauthorizedHttpException('jwt-auth', $e->getMessage(), $e, $e->getCode());
        }
    }

    protected function generateUniqueIdentifier($length = 40)
    {
        try {
            return \bin2hex(\random_bytes($length));
            // @codeCoverageIgnoreStart
        } catch (Error $e) {
            throw \UnexpectedValueException('An unexpected error has occurred', 0, $e);
        } catch (Exception $e) {
            // If you get this message, the CSPRNG failed hard.
            throw \RuntimeException('Could not generate a random string', 0, $e);
        }
        // @codeCoverageIgnoreEnd
    }
}
