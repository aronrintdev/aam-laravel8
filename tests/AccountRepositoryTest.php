<?php

use App\Models\Account;
use App\Repositories\AccountRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;
use Tests\ApiTestTrait;
use Tests\Traits\MakeAccountTrait;

class AccountRepositoryTest extends TestCase
{
    use MakeAccountTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AccountRepository
     */
    protected $accountRepo;

    public function setUp() :void
    {
        parent::setUp();
        $this->accountRepo = App::make(AccountRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAccount()
    {
        $account = $this->fakeAccountData();
        $createdAccount = $this->accountRepo->create($account);
        $createdAccount = $createdAccount->toArray();
        $this->assertArrayHasKey('AccountID', $createdAccount);
        $this->assertNotNull($createdAccount['AccountID'], 'Created Account must have id specified');
        $this->assertNotNull(Account::find($createdAccount['AccountID']), 'Account with given id must be in DB');
        $this->assertModelData($account, $createdAccount);
    }

    /**
     * @test read
     */
    public function testReadAccount()
    {
        $account = $this->makeAccount();
        $dbAccount = $this->accountRepo->find($account->AccountID, ['*']);
        $dbAccount = $dbAccount->toArray();
        $this->assertModelData($account->toArray(), $dbAccount);
    }

    /**
     * @test update
     */
    public function testUpdateAccount()
    {
        $account = $this->makeAccount();
        $fakeAccount = $this->fakeAccountData();
        $updatedAccount = $this->accountRepo->update($fakeAccount, $account->AccountID);
        $this->assertModelData($fakeAccount, $updatedAccount->toArray());
        $dbAccount = $this->accountRepo->find($account->AccountID, ['*']);
        $this->assertModelData($fakeAccount, $dbAccount->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAccount()
    {
        $account = $this->makeAccount();
        $resp = $this->accountRepo->delete($account->AccountID);
        $this->assertTrue($resp);
        $this->assertNull(Account::find($account->AccountID), 'Account should not exist in DB');
    }
}
