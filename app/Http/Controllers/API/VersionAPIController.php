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

class VersionAPIController {

    /**
     * @param string $id
     * @return Response
     *
     * @OA\GET(
     *   path="/apicheck/",
     *   summary="Get list of supported api version",
     *   @OA\MediaType(
     *     mediaType="application/json"
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
    public function check(Request $request)
    {
        return response()->json([
            'current'=> [
                [
                    'version' => '201902',
                    'path'    => '/api201902/',
                ],
                [
                    'version' => 'legacy',
                    'path'    => '/',
                ],
            ],
            'expiring'=>[
            ]
        ]);
    }
}
