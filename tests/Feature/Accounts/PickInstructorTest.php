<?php

namespace Tests\Feature\Accounts;

use App\Models\Account;
use App\Models\InstructorStudentsMulti;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;

class InstructorApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_creates_relation_between_student_and_instructor()
    {
        $this->user = new \App\User([
            'email' => 'some-customer@example.test',
            'AccountID'  => 48,
            'account_id' => 48,
        ]);
        $this->token = \JWTAuth::fromUser($this->user);  
        $response = $this->actingAs($this->user, 'api')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->withCookies([
            'token' =>$this->token,
        ])->post('/api201902/accounts/48/pick/1', [
        ]);

        $result = InstructorStudentsMulti::where('AccountID', 48)
            ->where('InstructorID', 1)
            ->get();

        $this->assertTrue($result->count() == 1);
        $this->assertNull($result->first()->InstructorVerifiedAt);
    }

    /**
     * @test
     */
    public function instructor_can_finalize_relationship()
    {
        $accountId    = 48;
        $instructorId = 1;
        $rel = InstructorStudentsMulti::create([
            'AccountID'         => $accountId,
            'InstructorID'      => $instructorId,
            'StudentVerifiedAt' => \Carbon\Carbon::now(),
        ]);

        $this->user = new \App\User([
            'email' => 'some-customer@example.test',
            'AccountID'  => 1,
        ]);
        $this->token = \JWTAuth::fromUser($this->user);  
        $response = $this->actingAs($this->user, 'api')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->withCookies([
            'token' =>$this->token,
        ])->post('/api201902/accounts/48/pick/1', [
        ]);

        $result = InstructorStudentsMulti::where('AccountID', $accountId)
            ->where('InstructorID', $instructorId)
            ->get();

        $this->assertTrue($result->count() == 1);
        $this->assertNotNull($result->first()->StudentVerifiedAt);
        $this->assertNotNull($result->first()->InstructorVerifiedAt);
    }

    /**
     * @test
     */
    public function robot_users_create_fully_approved_relationship()
    {
        $accountId    = 58;
        $instructorId = 1;
        $this->user = new \App\User([
            'email' => 'some-customer@example.test',
        ]);
        $this->user->api_token = 'b13';

        $this->token = \JWTAuth::fromUser($this->user);  
        $response = $this->actingAs($this->user, 'backend')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->withCookies([
            'token' =>$this->token,
        ])->post('/api201902/accounts/'.$accountId.'/pick/'.$instructorId, [
        ]);
        //$response->dump();            

        $result = InstructorStudentsMulti::where('AccountID', $accountId)
            ->where('InstructorID', $instructorId)
            ->get();

        $this->assertTrue($result->count() == 1);
        $this->assertNotNull($result->first()->InstructorVerifiedAt);
    }

    /**
     * @test
     */
    public function it_denies_access_to_other_user_accounts()
    {
        $this->user = new \App\User([
            'email' => 'some-customer@example.test',
            'AccountID'  => 48,
        ]);
        $this->token = \JWTAuth::fromUser($this->user);  
        $response = $this->actingAs($this->user, 'api')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->withCookies([
            'token' =>$this->token,
        ])->post('/api201902/accounts/18/pick/1', [
        ]);

        $response->assertStatus(403);
    }
}
