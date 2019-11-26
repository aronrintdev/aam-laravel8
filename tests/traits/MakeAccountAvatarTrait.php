<?php
namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\AccountAvatar;
use App\Repositories\AccountAvatarRepository;

trait MakeAccountAvatarTrait
{
    /**
     * Create fake instance of AccountAvatar and save it in database
     *
     * @param array $accountAvatarFields
     * @return AccountAvatar
     */
    public function makeAccountAvatar($accountAvatarFields = [])
    {
        return tap($this->fakeAccountAvatar($accountAvatarFields), function($item) {
            $item->save();
        });
    }

    /**
     * Get fake instance of AccountAvatar
     *
     * @param array $accountAvatarFields
     * @return AccountAvatar
     */
    public function fakeAccountAvatar($accountAvatarFields = [])
    {
        return new AccountAvatar($this->fakeAccountAvatarData($accountAvatarFields));
    }

    /**
     * Get fake data of AccountAvatar
     *
     * @param array $accountAvatarFields
     * @return array
     */
    public function fakeAccountAvatarData($accountAvatarFields = [])
    {
        $fake = Faker::create();
        $fake->seed(1234);

        return array_merge([
            'AccountID' => $fake->numberBetween(1,20),
            'AvatarURL' => $fake->word,
            'CreatedAt' => $fake->date('Y-m-d H:i:s.u'),
            'UpdatedAt' => $fake->date('Y-m-d H:i:s.u')
        ], $accountAvatarFields);
    }
}
