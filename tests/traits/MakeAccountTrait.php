<?php

namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Account;
use App\Repositories\AccountRepository;

trait MakeAccountTrait
{
    /**
     * Create fake instance of Account and save it in database
     *
     * @param array $accountFields
     * @return Account
     */
    public function makeAccount($accountFields = [])
    {
        /** @var AccountRepository $accountRepo */
        $accountRepo = App::make(AccountRepository::class);
        $theme = $this->fakeAccountData($accountFields);
        return $accountRepo->create($theme);
    }

    /**
     * Get fake instance of Account
     *
     * @param array $accountFields
     * @return Account
     */
    public function fakeAccount($accountFields = [])
    {
        return new Account($this->fakeAccountData($accountFields));
    }

    /**
     * Get fake data of Account
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAccountData($accountFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'OldAccountID' => $fake->randomDigitNotNull,
            'CardExpires' => $fake->word,
            'BillPhone' => $fake->word,
            'LastName_U' => $fake->word,
            'LessonLevel' => $fake->word,
            'CxnSpeed' => $fake->word,
            'LastName' => $fake->word,
            'Birthdate' => $fake->date('Y-m-d H:i:s'),
            'AlwaysUseDefault' => $fake->word,
            'CardType' => $fake->word,
            'Phone' => $fake->word,
            'AutoSMS' => $fake->word,
            'NotifyMe' => $fake->word,
            'Email' => $fake->word,
            'Vimeo_Token' => $fake->word,
            'PasswordEx' => $fake->word,
            'BillState' => $fake->word,
            'Address' => $fake->word,
            'Optout' => $fake->word,
            'Password' => $fake->word,
            'LessonLocation' => $fake->word,
            'SiteID' => $fake->word,
            'CardNumberEx' => $fake->word,
            'Zip' => $fake->word,
            'BillPhoneExt' => $fake->word,
            'BillStreet' => $fake->word,
            'LessonAgeRange' => $fake->word,
            'OS' => $fake->word,
            'Balance' => $fake->randomDigitNotNull,
            'CardCVV' => $fake->word,
            'InstructorID' => $fake->randomDigitNotNull,
            'CardDescript' => $fake->word,
            'ProCodeUpdate' => $fake->word,
            'BillApt' => $fake->word,
            'CookieLogin' => $fake->word,
            'AutoFB' => $fake->word,
            'Closed' => $fake->word,
            'FB_OAuth_Token' => $fake->word,
            'BillZip' => $fake->word,
            'City' => $fake->word,
            'CardHolder' => $fake->word,
            'FB_UserID' => $fake->word,
            'Country' => $fake->word,
            'PasswordSalt' => $fake->word,
            'State' => $fake->word,
            'BillCompany' => $fake->word,
            'FB_SessionKey' => $fake->word,
            'LessonGender' => $fake->word,
            'LastAccessed' => $fake->date('Y-m-d H:i:s'),
            'DateOpened' => $fake->date('Y-m-d H:i:s'),
            'PasswordHash' => $fake->word,
            'AddressHeader' => $fake->word,
            'BillCity' => $fake->word,
            'CardNumber' => $fake->word,
            'LessonFeeRange' => $fake->word,
            'FirstName_U' => $fake->word,
            'FirstName' => $fake->word,
            'Gender' => $fake->word
        ], $accountFields);
    }
}
