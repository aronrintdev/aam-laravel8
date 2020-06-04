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


class UserController extends Controller {

    public $successStatus = 200;


	/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     *
     * @OA\Post(
     *   path="/login",
     *   summary="Create new JWT",
     *   tags={"login"},
     *   description="User Login",
     *   @OA\RequestBody(
     *     description="login credentials",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(
     *         type="object",
     *         @OA\Property(
     *           property="email",
     *           type="string"
     *         ),
     *         @OA\Property(
     *           property="password",
     *           type="string"
     *         ),
     *         @OA\Property(
     *           property="remember",
     *           type="string"
     *         ),
     *       )
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *   )
     * )
     */
    public function login(Request $request){ 
        $credentials = $request->only('email', 'password');
        if (count($credentials) !== 2) {
            return response()->json(['error'=>'Incorrect credentials'], 422);
        }
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error'=>'Incorrect credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::user();
        $ua = $request->header('User-Agent');
        if (empty($ua)) {
            $ua = 'web';
        }

        $additionalJsonReponse = [];
        if ($request->get('remember') == '1') {
            $refreshToken = $this->generateUniqueIdentifier();
            $result = \DB::table('jwt_refresh_tokens')->insert([
                'refresh_token' => $refreshToken,
                'user_agent'    => substr($request->input('device_name', $ua), 0, 255),
                'user_id'       => $user->AccountID,
                'expires'       => \Carbon\Carbon::now()->addMonths(6),
                'revoked'       => 0,
            ]);
            $additionalJsonReponse = ['refresh_token'=>$refreshToken];
        }

        return response()->json(array_merge([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl', 60) * 60
        ], $additionalJsonReponse))
        ->withCookie( cookie('token', $token, 60*60));
        //cookie name token is not configurable (yet) by JWT
//        return response()->json(compact('token'));
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
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
		$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('vos-accounts')->accessToken; 
        $success['name'] =  $user->name;
		return response()->json(['success'=>$success], $this->successStatus); 
    }

	/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     *
     * @OA\GET(
     *   path="/me",
     *   summary="Get logged in user details",
     *   tags={"login"},
     *   description="User Info",
     *   @OA\Response(
     *     response="200",
     *     description="successful operation",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/success")},
     *         @OA\Property(
     *           property="data",
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/user")
     *         )
     *       )
     *     )
     *   ),
     * )
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
		$encoder = Encoder::instance([
				Account::class => UserSchema::class,
				AccountUser::class => UserSchema::class,
				User::class => UserSchema::class,
				Academy::class => AcademySchema::class,
			])
			->withIncludedPaths([
				'academies',
				'owned_academies',
			])
			->withEncodeOptions(JSON_PRETTY_PRINT);

        return response($encoder->encodeData($user));
    } 
}
