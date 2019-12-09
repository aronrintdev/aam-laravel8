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
        $accountRepo = \App::make(AccountRepository::class);
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
            'Email' => $fake->email,
            'CardExpires' => '',
            'LastName_U' => $fake->word,
            'CxnSpeed' => null,
            'LastName' => $fake->word,
            'Birthdate' => $fake->date('Y-m-d H:i:s.v'),
            'AlwaysUseDefault' => $fake->boolean,
            'Phone' => null,
            'AutoSMS' => $fake->boolean,
            'AutoFB' => $fake->boolean,
            'NotifyMe' => $fake->boolean,
            'CookieLogin' => $fake->boolean,
            'Vimeo_Token' => null,
            'Address' => null,
            'Optout' => null,
            'Password' => $fake->word,
            'SiteID' => substr($fake->word, 0, 4),
            'CardNumberEx' => $fake->word,
            'Zip' => null,
            'OS' => null,
            'Balance' => $fake->randomDigitNotNull,
            'CardCVV' => null,
            'CardType' => null,
            'InstructorID' => $fake->randomDigitNotNull,
            'CardDescript' => null,
            'ProCodeUpdate' => null,
            'BillCompany' => $fake->word,
            'BillStreet' => null,
            'BillCity' => null,
            'BillState' => null,
            'BillApt' => null,
            'BillZip' => null,
            'BillPhone' => null,
            'BillPhoneExt' => null,
            'Closed' => $fake->boolean,
            'FB_OAuth_Token' => $fake->word,
            'City' => $fake->word,
            'CardHolder' => $fake->word,
            'FB_UserID' => null,
            'Country' => $fake->countryCode,
            'State' => null,
            'FB_SessionKey' => null,
            'LastAccessed' => $fake->date('Y-m-d H:i:s.v'),
            'DateOpened' => $fake->date('Y-m-d H:i:s.v'),
            'PasswordHash' => null,
            'PasswordSalt' => null,
            'PasswordEx' => null,
            'AddressHeader' => $fake->word,
            'CardNumber' => null,
            'LessonFeeRange' => null,
            'LessonLevel' => null,
            'LessonAgeRange' => null,
            'LessonGender' => null,
            'LessonLocation' => null,
            'FirstName_U' => $fake->word,
            'FirstName' => $fake->word,
            'Gender' => $fake->boolean
        ], $accountFields);
    }
}
