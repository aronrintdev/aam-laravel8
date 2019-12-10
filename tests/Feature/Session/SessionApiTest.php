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

        $academyId = 'V1AC';
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

        $academyId = 'SHYG';
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
}
