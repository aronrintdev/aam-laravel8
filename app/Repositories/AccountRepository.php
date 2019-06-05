<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\BaseRepository;

/**
 * Class AccountRepository
 * @package App\Repositories
 * @version April 2, 2019, 10:05 pm UTC
*/

class AccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'AccountID',
        'OldAccountID',
        'CardExpires',
        'BillPhone',
        'LastName_U',
        'LessonLevel',
        'CxnSpeed',
        'LastName',
        'Birthdate',
        'AlwaysUseDefault',
        'CardType',
        'Phone',
        'AutoSMS',
        'NotifyMe',
        'email',
        'Email',
        'Vimeo_Token',
        'PasswordEx',
        'BillState',
        'Address',
        'Optout',
        'Password',
        'LessonLocation',
        'SiteID',
        'CardNumberEx',
        'Zip',
        'BillPhoneExt',
        'BillStreet',
        'LessonAgeRange',
        'OS',
        'Balance',
        'CardCVV',
        'InstructorID',
        'CardDescript',
        'ProCodeUpdate',
        'BillApt',
        'CookieLogin',
        'AutoFB',
        'Closed',
        'FB_OAuth_Token',
        'BillZip',
        'City',
        'CardHolder',
        'FB_UserID',
        'Country',
        'PasswordSalt',
        'State',
        'BillCompany',
        'FB_SessionKey',
        'LessonGender',
        'LastAccessed',
        'DateOpened',
        'PasswordHash',
        'AddressHeader',
        'BillCity',
        'CardNumber',
        'LessonFeeRange',
        'FirstName_U',
        'FirstName',
        'Gender'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Account::class;
    }
}
