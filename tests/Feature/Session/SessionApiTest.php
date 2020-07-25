<?php

namespace Tests\Feature\Session;


use App\AccountUser;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;

class SessionApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function test_switch_to_same_academy_updates_token()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withoutMiddleware(\App\Http\Middleware\EnableCors::class);

        $academyId = 'PPRO';
        $pauline = AccountUser::find(1);
        //can't do json call with cookies in 5.8
        $headers = [
            'CONTENT_LENGTH' => mb_strlen('', '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];
        $token = \JWTAuth::fromUser($pauline);
        $this->response = $this->actingAs($pauline, 'api')
            ->call('POST', '/api201902/session/'.$academyId.'/switch', [],
                [
                    'token' => $token
                ],
                [],
                $headers
            );
        $this->response->assertStatus(200);
        $this->response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
        $blob = explode('.', $this->response->getData()->access_token);
        $jwt = json_decode( base64_decode($blob[1]), true);
        $this->assertEquals($academyId, $jwt['accid']);
    }


    /**
     * @test
     */
    public function test_switch_to_rogue_academy_returns_unauthorized()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withoutMiddleware(\App\Http\Middleware\EnableCors::class);

        $academyId = 'BALL';
        $pauline = AccountUser::find(1);
        //can't do json call with cookies in 5.8
        $headers = [
            'CONTENT_LENGTH' => mb_strlen('', '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];
        $token = \JWTAuth::fromUser($pauline);
        $this->response = $this->actingAs($pauline, 'api')
            ->call('POST', '/api201902/session/'.$academyId.'/switch', [],
                [
                    'token' => $token
                ],
                [],
                $headers
            );
        $this->response->assertStatus(403);
    }

    /**
     * @test
     */
    public function test_switch_to_different_academy_updates_token()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withoutMiddleware(\App\Http\Middleware\EnableCors::class);

        $academyId = 'FORE';
        $bill = AccountUser::find(1);
        //can't do json call with cookies in 5.8
        $headers = [
            'CONTENT_LENGTH' => mb_strlen('', '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];
        $token = \JWTAuth::fromUser($bill);
        $this->response = $this->actingAs($bill, 'api')
            ->call('POST', '/api201902/session/'.$academyId.'/switch', [],
                [
                    'token' => $token
                ],
                [],
                $headers
            );
        $this->response->assertStatus(200);
        $this->response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
        $blob = explode('.', $this->response->getData()->access_token);
        $jwt = json_decode( base64_decode($blob[1]), true);
        $this->assertEquals($academyId, $jwt['accid']);
    }


    /**
     * @test
     */
    public function test_check_jwt_signature()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withoutMiddleware(\App\Http\Middleware\EnableCors::class);

        $academyId = 'SHYG';
        $bill = AccountUser::find(5);
        //can't do json call with cookies in 5.8
        $headers = [
            'CONTENT_LENGTH' => mb_strlen('', '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];
        $token = \JWTAuth::fromUser($bill);
        $this->response = $this->actingAs($bill, 'api')
            ->call('POST', '/api201902/session/check', [],
                [
                    'token' => $token
                ],
                [],
                $headers
            );
        $this->response->assertStatus(200);
        $this->response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
        $this->assertEquals(14400, $this->response->getData()->expires_in);
    }


    /**
     * @test
     */
    public function test_bad_jwt_signature_throws_error()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withoutMiddleware(\App\Http\Middleware\EnableCors::class);

        $academyId = 'SHYG';
        $bill = AccountUser::find(5);
        //can't do json call with cookies in 5.8
        $headers = [
            'CONTENT_LENGTH' => mb_strlen('', '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];
        $token = \JWTAuth::fromUser($bill);
        $token .= 'qqqqq';
        $this->response = $this->actingAs($bill, 'api')
            ->call('POST', '/api201902/session/check', [],
                [
                    'token' => $token
                ],
                [],
                $headers
            );
        $this->response->assertStatus(401);
        $this->response->assertJsonStructure(['errors']);
    }

    /**
     * @test
     */
    public function test_refresh_session_sends_new_refresh_token()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withoutMiddleware(\App\Http\Middleware\EnableCors::class);

        $sam = AccountUser::find(5);
        //can't do json call with cookies in 5.8
        $headers = [
            //'CONTENT_LENGTH' => mb_strlen('', '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];
        $token   = \JWTAuth::fromUser($sam);
        $refresh = \bin2hex(\random_bytes(40));

        $headers['Authorization'] = 'Bearer ' . $token;

        $result = \DB::table('jwt_refresh_tokens')->insert([
            'refresh_token' => $refresh,
            'user_agent'    => "User-Agent",
            'user_id'       => $sam->AccountID,
            'expires'       => \Carbon\Carbon::now()->addMonths(6),
            'revoked'       => 0,
        ]);
        $headers = $this->transformHeadersToServerVars($headers);

        $this->response = $this->actingAs($sam, 'api')
            ->call('POST', '/api201902/session/refresh',
                //params
                [
                ],
                //cookies
                [
                ],
                //files
                [],
                //server-vars
                $headers,
                //body
                json_encode(['refresh_token' => $refresh ]),
            );
        $this->response->assertStatus(200);
        $this->response->assertJsonStructure(['access_token', 'token_type', 'expires_in', 'refresh_token']);
        $blob = explode('.', $this->response->getData()->access_token);
        $jwt = json_decode( base64_decode($blob[1]), true);
        $this->assertEquals($sam->AccountID, $jwt['aid']);
        $this->assertEquals($sam->Email, $jwt['sub']);
    }
}
