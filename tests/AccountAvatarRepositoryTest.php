<?php namespace Tests\Repositories;

use App\Models\AccountAvatar;
use App\Repositories\AccountAvatarRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAccountAvatarTrait;
use Tests\ApiTestTrait;

class AccountAvatarRepositoryTest extends TestCase
{
    use MakeAccountAvatarTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AccountAvatarRepository
     */
    protected $accountAvatarRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->accountAvatarRepo = \App::make(AccountAvatarRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_account_avatar()
    {
        $accountAvatar = $this->fakeAccountAvatarData();
        $createdAccountAvatar = $this->accountAvatarRepo->create($accountAvatar);
        $createdAccountAvatar = $createdAccountAvatar->toArray();
        $this->assertArrayHasKey('AccountAvatarID', $createdAccountAvatar);
        $this->assertNotNull($createdAccountAvatar['AccountAvatarID'], 'Created AccountAvatar must have id specified');
        $this->assertNotNull(AccountAvatar::find($createdAccountAvatar['AccountAvatarID']), 'AccountAvatar with given id must be in DB');
        $this->assertModelData($accountAvatar, $createdAccountAvatar);
    }

    /**
     * @test read
     */
    public function test_read_account_avatar()
    {
        $accountAvatar = $this->makeAccountAvatar();
        $dbAccountAvatar = $this->accountAvatarRepo->find($accountAvatar->AccountAvatarID);
        $dbAccountAvatar = $dbAccountAvatar->toArray();
        $this->assertModelData($accountAvatar->toArray(), $dbAccountAvatar);
    }

    /**
     * @test update
     */
    public function test_update_account_avatar()
    {
        $accountAvatar = $this->makeAccountAvatar();
        $fakeAccountAvatar = $this->fakeAccountAvatarData();
        $updatedAccountAvatar = $this->accountAvatarRepo->update($fakeAccountAvatar, $accountAvatar->AccountAvatarID);
        $this->assertModelData($fakeAccountAvatar, $updatedAccountAvatar->toArray());
        $dbAccountAvatar = $this->accountAvatarRepo->find($accountAvatar->AccountAvatarID);
        $this->assertModelData($fakeAccountAvatar, $dbAccountAvatar->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_account_avatar()
    {
        $accountAvatar = $this->makeAccountAvatar();
        $resp = $this->accountAvatarRepo->delete($accountAvatar->AccountAvatarID);
        $this->assertTrue($resp);
        $this->assertNull(AccountAvatar::find($accountAvatar->AccountAvatarID), 'AccountAvatar should not exist in DB');
    }
}
