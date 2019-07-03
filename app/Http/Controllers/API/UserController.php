<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error'=>'Incorrect credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => env('JWT_TTL', 60) * 60
        ])
        ->withCookie( cookie('token', $token, 60*60));
        //cookie name token is not configurable (yet) by JWT
//        return response()->json(compact('token'));
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
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this->successStatus); 
    } 
}
