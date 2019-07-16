<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Models\PendingRegistration;
use App\Http\Controllers\Controller;
use App\Repositories\AccountRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;


/**
 * Class RegisterController
 * @package App\Http\Controllers\API
 *
 * @OA\Response(
 *   response="Register",
 *   description="Awaiting Verification",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        @OA\Property(
 *         property="message",
 *       )
 *     )
 *   )
 * )
 */


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *   path="/register/",
     *   summary="Register an account",
     *   tags={"Register"},
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\RequestBody(
     *     description="Account that should be updated",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       example={"email": "foo@example.com", "name": "Test User", "password": "SuperS3cr3t", "password_confirmation": "SuperS3cr3t",},
     *       @OA\Schema(
     *         @OA\Property(
     *           property="email",
     *         ),
     *         @OA\Property(
     *           property="name",
     *           description="first and last",
     *         ),
     *         @OA\Property(
     *           property="password",
     *           description="password",
     *         ),
     *         @OA\Property(
     *           property="password_confirmation",
     *           description="password again",
     *         ),
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Validation Successfully sent",
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Validation failed",
     *   )
     * )
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        //check email is unique in API
        $this->checkEmailUnique($request->input('email'));

        $code = md5(rand(00100,999999));

        PendingRegistration::create([
            'email'=>$request->input('email'),
            'request'=>$request->all(),
            'code'=>$code
        ]);

        $url = $request->input('url', '');
        //\Log::info('URL ' . $url, ['all'=> $request->all()]);
        $user = new \App\User(['Email'=>$request->input('email')]);
        $mail   = new \App\Mail\RegistrationVerification($user, $code, $request->input('url', ''));
        Mail::to( $user->Email )->send($mail);

        /*
        $ve = new \Illuminate\Auth\Notifications\VerifyEmail();
        $mail = $ve->toMail($user);
        $toList  = [ $request->input('email') ];
        \Notification::send([$user], $ve);
         */

        $respjson = ['message'=>'Verification successfully sent'];
        //obviously don't send code with the response, this is just for testing
        if (config('app.env') == 'testing' || config('app.env') == 'local') {
            $respjson['code'] = $code;
        }

        return response()->json($respjson);
    }


    /**
     * Activate a registration after email is verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *   path="/register/activate/{code}",
     *   summary="Activate a registration request",
     *   tags={"Register"},
     *   @OA\MediaType(
     *     mediaType="application/json"
     *   ),
     *   @OA\RequestBody(
     *     description="Verification code",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       example={"code": "1234567890abcdef"},
     *       @OA\Schema(
     *         @OA\Property(
     *           property="code",
     *         ),
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Registration now active",
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Code expired or not found",
     *   )
     * )
     */
    public function activate(Request $request, $code)
    {
        $pending = PendingRegistration::where('code', '=', $code)
            ->whereNull('verified_at')
            ->first();

        if (!$pending) {
            //422 Unprocessable Entity
            \Log::info('Cannot find registration code', ['code'=>$code]);
            return response()->json(['status'=>'error', 'message'=>'No such activation code or activation expired'], 422);
        }

        event(new Registered($user = $this->create($pending->request)));


        \Log::info('user registered', ['user'=>$user]);


        /*
         *        $credentials = $request->only('email', 'password');
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
         */


        $this->guard()->login($user);

        $pending->verified_at  = \Carbon\Carbon::now();
        $pending->save();
        return response()->json([]);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function checkEmailUnique($email) {
        $accountRepository = new AccountRepository(app());
        $emails = $accountRepository->all(['Email'=>$email])->all();
        if (!empty($emails)) {
            throw \Illuminate\Validation\ValidationException::withMessages(['email'=>'Email address already registered']);
        }
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $newSalt = substr(base64_encode(random_bytes(16)), 0, 16);
        $newPassword = hash('sha256', $newSalt. hash('sha256', $data['password'] . $newSalt));

        $names = explode(' ', $data['name']);
        $firstname = @array_shift($names);
        $lastname = implode(' ', $names);

        $a = new \App\Models\Account([
            'FirstName'    => $firstname,
            'LastName'     => $lastname,
            'Email'        => $data['email'],
            'PasswordSalt' => $newSalt,
            'PasswordHash' => $newPassword,
        ]);
        $a->save();
        $u = new User([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $newPassword,
        ]);

        return $u;
    }
}
