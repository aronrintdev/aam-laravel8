<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAccountTrait;
use Tests\ApiTestTrait;


class AccountApiTest extends TestCase
{
    use MakeAccountTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAccount()
    {
        $account = $this->fakeAccountData();
        $this->response = $this->json('POST', '/api201902/accounts', $account);

        $this->response->assertStatus(403);
        //$this->assertApiResponse($account);
    }

    /**
     * @test
     */
    public function testReadAccount()
    {
        $account = $this->makeAccount();
        $this->response = $this->json('GET', '/api201902/accounts/'.$account->AccountID);

        $this->assertApiResponse($account->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAccount()
    {
        $account = $this->makeAccount();
        $editedAccount = $this->fakeAccountData();

        $this->response = $this->json('PUT', '/api201902/accounts/'.$account->AccountID, $editedAccount);

        $this->response->assertStatus(403);
        //$this->assertApiResponse($editedAccount);
    }

    /**
     * @test
     */
    public function testDeleteAccount()
    {
        $account = $this->makeAccount();
        $this->response = $this->json('DELETE', '/api201902/accounts/'.$account->AccountID);

        $this->response->assertStatus(403);
        //$this->assertApiSuccess();
        $this->response = $this->json('GET', '/api201902/accounts/'.$account->AccountID);

        $this->response->assertStatus(200);
        //$this->response->assertStatus(404);
    }
}
