<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAccountAvatarTrait;
use Tests\ApiTestTrait;

class AccountAvatarApiTest extends TestCase
{
    use MakeAccountAvatarTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_account_avatar()
    {
        $accountAvatar = $this->fakeAccountAvatarData();
        $this->response = $this->call('POST', '/api201902/avatar/'.$accountAvatar['AccountID'],
            [],
            [],
            [],
            [
            'HTTP_CONTENT_LENGTH' => 10,
            'CONTENT_TYPE' => 'application/octet-stream',
            ],
            'pngcontent'
        );


        //transform sql server keys to api keys (lowercase and underscores)

        $this->assertApiResponse([
            'type'=>'avatar',
            'attributes'=> [
                'account_id' => $accountAvatar['AccountID'],
                'url'=>'http://test.test/foo.png',
            ]
        ]);
    }

    /**
     * @ test
     */
    public function off__read_account_avatar()
    {
        $accountAvatar = $this->makeAccountAvatar();
        $this->response = $this->json('GET', '/api201902/avatar/'.$accountAvatar['AccountID']);

        $this->assertApiResponse($accountAvatar->toArray());
    }

    /**
     * @ test
     */
    public function off_update_account_avatar()
    {
        $accountAvatar = $this->makeAccountAvatar();
        $editedAccountAvatar = $this->fakeAccountAvatarData();

        $this->response = $this->json('PUT', '/api201902/avatar/'.$accountAvatar->AccountID, $editedAccountAvatar);

        $this->assertApiResponse($editedAccountAvatar);
    }

    /**
     * @ test
     */
    public function off_delete_account_avatar()
    {
        $accountAvatar = $this->makeAccountAvatar();
        $this->response = $this->json('DELETE', '/api201902/avatar/'.$accountAvatar->AccountID);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api201902/avatar/'.$accountAvatar->AccountID);

        $this->response->assertStatus(404);
    }
}
