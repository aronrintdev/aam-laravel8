<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\V1UserProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except(['logout', 'loginas']);
    }

    public function loginas(Request $request)
    {
        $accountId = (int)$request->input('account_id');
        //$user = \App\AccountUser::find($accountId);
        $v1up = new V1UserProvider(\DB::connection('sqlsrv'));
        $user = $v1up->byId($accountId);

        if (!$user) {
            echo "cannot find user with id " . $accountId;
            return;
        }

        if (! $token = \JWTAuth::fromUser($user)) {
            return response()->json(['error'=>'Incorrect credentials'], 401);
        }
        $host = 'https://app.v1sports.com';
        if (config('app.env') == 'local') {
            $host = 'http://v1a.test:8000';
        }
        if (config('app.env') == 'stage') {
            $host = 'https://stage.app.v1sports.com';
        }
        if (config('app.env') == 'testing') {
            $host = 'https://test.app.v1sports.com';
        }

        return view('admin/loginas', [
            'access_token' => $token,
            'marketplaceHost' => $host,
        ]);
    }
}
