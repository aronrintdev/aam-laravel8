<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountApiTest extends TestCase
{
    use MakeAccountTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAccount()
    {
        $account = $this->fakeAccountData();
        $this->json('POST', '/api/v1/accounts', $account);

        $this->assertApiResponse($account);
    }

    /**
     * @test
     */
    public function testReadAccount()
    {
        $account = $this->makeAccount();
        $this->json('GET', '/api/v1/accounts/'.$account->AccountID);

        $this->assertApiResponse($account->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAccount()
    {
        $account = $this->makeAccount();
        $editedAccount = $this->fakeAccountData();

        $this->json('PUT', '/api/v1/accounts/'.$account->AccountID, $editedAccount);

        $this->assertApiResponse($editedAccount);
    }

    /**
     * @test
     */
    public function testDeleteAccount()
    {
        $account = $this->makeAccount();
        $this->json('DELETE', '/api/v1/accounts/'.$account->AccountID);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/accounts/'.$account->AccountID);

        $this->assertResponseStatus(404);
    }
}
