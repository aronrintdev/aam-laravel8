<?php 

namespace Tests\Feature\Avatars;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
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
	\Storage::fake('do-vos-media');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $accountAvatar = $this->fakeAccountAvatarData();
        $accountAvatar['AccountID'] = 3;
        $user = \App\AccountUser::find(3);
        $this->response = $this->actingAs($user)
            ->call('POST', '/api201902/avatar/'.$user->AccountID,
            [
                'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            ],
        );

        //transform sql server keys to api keys (lowercase and underscores)

        $this->response->assertJson([
            'data' => [
                'type'=>'avatar',
                'attributes'=> [
                    'account_id' => $accountAvatar['AccountID'],
                ]
            ]
        ]);
    }

    /**
     * @test
     */
    public function test_read_account_avatar()
    {
        $accountAvatar = $this->makeAccountAvatar();
        $this->response = $this->json('GET', '/api201902/avatar/'.$accountAvatar->AccountID);

        $this->response->assertJson([
            'data' => [
                'type'=>'avatar',
                'attributes'=> [
                    'account_id' => $accountAvatar->AccountID,
                    'url'        => $accountAvatar->AvatarURL,
                ]
            ]
        ]);
    }

    /**
     * @test
     */
    public function test_dont_allow_control_other_accounts()
    {
	\Storage::fake('do-vos-media');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $accountAvatar = $this->fakeAccountAvatarData();
        $accountAvatar['AccountID'] = 3;
        $user = \App\AccountUser::find(4);
        $this->response = $this->actingAs($user)
            ->call('POST', '/api201902/avatar/'.$accountAvatar['AccountID'],
            [
                'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            ],
        );

        $this->response
            ->assertStatus(\Illuminate\Http\Response::HTTP_FORBIDDEN);
        //this doesn't work for JSON responses
        //$this->response->assertUnauthorized();
    }


    /**
     * @test
     */
    public function test_update_account_avatar()
    {
	\Storage::fake('do-vos-media');
        $file = UploadedFile::fake()->image('avatar.jpg');
        #$accountAvatar = $this->fakeAccountAvatarData();
        $accountAvatar = $this->makeAccountAvatar();
        #$accountAvatar['AccountID'] = 3;
        $user = \App\AccountUser::find($accountAvatar['AccountID']);
        $this->response = $this->actingAs($user)
            ->call('PATCH', '/api201902/avatar/'.$accountAvatar['AccountID'],
            [
                'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            ],
        );

        $this->response->assertJson([
            'data' => [
                'type'=>'avatar',
                'attributes'=> [
                    'account_id' => $accountAvatar['AccountID'],
                ]
            ]
        ]);
    }

    /**
     * @test
     */
    public function test_delete_account_avatar()
    {
	\Storage::fake('do-vos-media');
        $accountAvatar = $this->makeAccountAvatar();

        $user = \App\AccountUser::find($accountAvatar['AccountID']);
        $this->response = $this->actingAs($user)
            ->call('DELETE', '/api201902/avatar/'.$accountAvatar['AccountID']);

        $this->response
            ->assertStatus(\Illuminate\Http\Response::HTTP_OK);
    }
}
