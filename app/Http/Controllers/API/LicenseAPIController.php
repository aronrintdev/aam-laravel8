<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\Account;
use App\Models\Academy;
use App\User; 
use App\AccountUser;
use Illuminate\Support\Facades\Auth; 
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Neomerx\JsonApi\Encoder\Encoder;

use App\Transformers\UserTransformer;
use App\Transformers\AcademySchema;
use App\Transformers\UserSchema;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;


class LicenseAPIController extends Controller {

	/** 
     * license api 
     * 
     * @return \Illuminate\Http\Response 
     *
     * @OA\GET(
     *   path="/licenses",
     *   summary="Get details about academy and user licenses",
     *   tags={"login"},
     *   description="License Info",
     *   @OA\Response(
     *     response="200",
     *     description="successful operation",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="data",
     *           type="array",
     *           @OA\Items(
     *             @OA\Property(
     *               property="id",
     *               type="integer",
     *             ),
     *             @OA\Property(
     *               property="attributes",
     *               type="object",
     *               @OA\Property(
     *                 property="code",
     *                 type="string",
     *               ),
     *               @OA\Property(
     *                 property="is_active",
     *                 type="boolean",
     *               ),
     *               @OA\Property(
     *                 property="start_date",
     *                 type="string",
     *                 format="date-time",
     *               ),
     *               @OA\Property(
     *                 property="name",
     *                 type="string",
     *               ),
     *             ),
     *           ),
     *         )
     *       )
     *     )
     *   )
     * )
     */ 
    public function index() 
    { 
        $user = Auth::user(); 
        //TODO: does an instructor at multiple academies only get
        //a Pro App license for 1 academy?
        //
        //$records = \DB::connection('sqlsrv')->select('SELECT * FROM Academies_AddOns
        //    WHERE AcademyID = ? and InstructorID = ?', [
        //    $user->AcademyID,
        //    $user->AccountID,
        //]);

        $academyRecords = \DB::connection('sqlsrv')->select('SELECT * FROM Academies_AddOns
            WHERE InstructorID = ?', [
            $user->AccountID,
        ]);

        $personalRecords = \DB::connection('sqlsrv')->select('SELECT * FROM V1GolfPlus
            WHERE AccountID = ?', [
            $user->AccountID,
        ]);

        return response()->json([
            'data' => array_merge([],
				$this->transformLicenseRecords($academyRecords),
				$this->transformPlusRecords($personalRecords),
            ),
        ]);
    }

    /**
     * Remove unsubbed records
     */
    public function transformPlusRecords($records) {
        $records = array_filter($records, function($item) {
            return $item->Unsubbed == null;
        });
        return array_map(function($item) {
            $startDate = \Carbon\Carbon::parse($item->Created, 'America/New_York');
            //DateTime::W3C format is the same as DateTime::RFC3339
            //SubID is stripe subscription ID, not always present, empty string if not available.
            return [
                'id' => $item->ID,
                'type' => 'license',
                'attributes' => [
                    'name'       => $item->AndroidPackage,
                    'serial'     => $item->SubID,
                    'code'       => strtolower(str_replace(' ', '_', $item->AndroidPackage)),
                    'start_date' => $startDate->toW3cString(),
                    'is_active'  => $item->Active == '1' ? true : false,
                ],
            ];
        }, $records);

    }

    public function transformLicenseRecords($records) {
        $records = array_filter($records, function($item) {
            return $item->DateDeleted == null;
        });
        return array_map(function($item) {
            //start date is unstructured varchar
            $parts = [];
            //format is m/d/Y   all matches = 0, m=1, d=2, y=3
            $count = preg_match('/([0-9]+)\/([0-9]+)\/([0-9]+)/', $item->StartDate, $parts);
            $startDate = \Carbon\Carbon::create($parts[3], $parts[1], $parts[2], 0, 0, 0, 'America/New_York');
            //DateTime::W3C format is the same as DateTime::RFC3339
            return [
                'id' => $item->AddOnID,
                'type' => 'license',
                'attributes' => [
                    'name'       => $item->AddOn_Description,
                    'serial'     => $item->SerialNumber,
                    'code'       => strtolower(str_replace(' ', '_', $item->AddOn_Description)),
                    'start_date' => $startDate->toW3cString(),
                    'is_active'  => $item->Live == '1' ? true : false,
                ],
            ];
        }, $records);
    }
}
