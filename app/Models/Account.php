<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *   schema="LegacyAccount",
 *   required={""},
 *   @OA\Property(
 *     property="AccountID",
 *     description="AccountID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="OldAccountID",
 *     description="OldAccountID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CardExpires",
 *     description="CardExpires",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BillPhone",
 *     description="BillPhone",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="LastName_U",
 *     description="LastName_U",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="LessonLevel",
 *     description="LessonLevel",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CxnSpeed",
 *     description="CxnSpeed",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="LastName",
 *     description="LastName",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="AlwaysUseDefault",
 *     description="AlwaysUseDefault",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="CardType",
 *     description="CardType",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="Phone",
 *     description="Phone",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="AutoSMS",
 *     description="AutoSMS",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="NotifyMe",
 *     description="NotifyMe",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="Email",
 *     description="Email",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Vimeo_Token",
 *     description="Vimeo_Token",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="PasswordEx",
 *     description="PasswordEx",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BillState",
 *     description="BillState",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Address",
 *     description="Address",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Optout",
 *     description="Optout",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="Password",
 *     description="Password",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="LessonLocation",
 *     description="LessonLocation",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SiteID",
 *     description="SiteID",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CardNumberEx",
 *     description="CardNumberEx",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Zip",
 *     description="Zip",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BillPhoneExt",
 *     description="BillPhoneExt",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BillStreet",
 *     description="BillStreet",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="LessonAgeRange",
 *     description="LessonAgeRange",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="OS",
 *     description="OS",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="Balance",
 *     description="Balance",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CardCVV",
 *     description="CardCVV",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="InstructorID",
 *     description="InstructorID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CardDescript",
 *     description="CardDescript",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="ProCodeUpdate",
 *     description="ProCodeUpdate",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="BillApt",
 *     description="BillApt",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CookieLogin",
 *     description="CookieLogin",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="AutoFB",
 *     description="AutoFB",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="Closed",
 *     description="Closed",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="FB_OAuth_Token",
 *     description="FB_OAuth_Token",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BillZip",
 *     description="BillZip",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="City",
 *     description="City",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CardHolder",
 *     description="CardHolder",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FB_UserID",
 *     description="FB_UserID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="Country",
 *     description="Country",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="PasswordSalt",
 *     description="PasswordSalt",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="State",
 *     description="State",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BillCompany",
 *     description="BillCompany",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FB_SessionKey",
 *     description="FB_SessionKey",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="LessonGender",
 *     description="LessonGender",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="PasswordHash",
 *     description="PasswordHash",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="AddressHeader",
 *     description="AddressHeader",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BillCity",
 *     description="BillCity",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CardNumber",
 *     description="CardNumber",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="LessonFeeRange",
 *     description="LessonFeeRange",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="FirstName_U",
 *     description="FirstName_U",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FirstName",
 *     description="FirstName",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Gender",
 *     description="Gender",
 *     type="boolean"
 *   )
 * )
 */

class Account extends Model
{
#    use SoftDeletes;

    public $table = 'Accounts';
    public $timestamps = false;

    
#    const CREATED_AT = 'created_at';
#    const UPDATED_AT = 'updated_at';


#    protected $dates = ['deleted_at'];

    protected $primaryKey = 'AccountID';

    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'DateOpened'   => 'datetime',
        'OldAccountID' => 'integer',
        'CardExpires' => 'string',
        'BillPhone' => 'string',
        'LastName_U' => 'string',
        'LessonLevel' => 'integer',
        'CxnSpeed' => 'integer',
        'LastName' => 'string',
        'AlwaysUseDefault' => 'boolean',
        'CardType' => 'integer',
        'AccountID' => 'integer',
        'Phone' => 'string',
        'AutoSMS' => 'boolean',
        'NotifyMe' => 'boolean',
        'Email' => 'string',
        'Vimeo_Token' => 'string',
        'PasswordEx' => 'string',
        'BillState' => 'string',
        'Address' => 'string',
        'Optout' => 'boolean',
        'Password' => 'string',
        'LessonLocation' => 'string',
        'SiteID' => 'string',
        'CardNumberEx' => 'string',
        'Zip' => 'string',
        'BillPhoneExt' => 'string',
        'BillStreet' => 'string',
        'LessonAgeRange' => 'integer',
        'OS' => 'integer',
        'Balance' => 'integer',
        'CardCVV' => 'string',
        'InstructorID' => 'integer',
        'CardDescript' => 'string',
        'ProCodeUpdate' => 'boolean',
        'BillApt' => 'string',
        'CookieLogin' => 'boolean',
        'AutoFB' => 'boolean',
        'Closed' => 'boolean',
        'FB_OAuth_Token' => 'string',
        'BillZip' => 'string',
        'City' => 'string',
        'CardHolder' => 'string',
        'FB_UserID' => 'integer',
        'Country' => 'string',
        'PasswordSalt' => 'string',
        'State' => 'string',
        'BillCompany' => 'string',
        'FB_SessionKey' => 'string',
        'LessonGender' => 'integer',
        'PasswordHash' => 'string',
        'AddressHeader' => 'string',
        'BillCity' => 'string',
        'CardNumber' => 'string',
        'LessonFeeRange' => 'integer',
        'FirstName_U' => 'string',
        'FirstName' => 'string',
        'Gender' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*
        'AccountID' => 'required',
        'NotifyMe' => 'required',
        'Email' => 'required',
        'Password' => 'required',
        'Balance' => 'required',
        'CookieLogin' => 'required',
        'Closed' => 'required',
        'FirstName' => 'required',
        'Gender' => 'required'
         */
    ];

    public function avatar() {
        return $this->hasOne(AccountAvatar::class, 'AccountID');
    }

    public function getAvatarURLAttribute() {

        $avatar = $this->avatar;
        if ($avatar && $avatar->exists()) {
            return $avatar->AvatarURL;
        }
        $r = route('api.avatar.default.image', (int)$this->AccountID);
        //replace with front-end accessible domain
        $parts = parse_url($r);
        return config('app.url') . $parts['path'];
    }

    /**
     * Copied form Instructor so that generic "user" could
     * find relationships with the same AccountID
     */
    public function academies() {
        return $this->belongsToMany('App\Models\Academy', 'AcademyInstructors', 'InstructorID', 'AcademyID')
            ->wherePivot('IsEnabled', 1);
    }

    /**
     * Copied form Instructor so that generic "user" could
     * find relationships with the same AccountID
     */
    public function academiesTeaching() {
        return $this->belongsToMany('App\Models\Academy', 'AcademyInstructors', 'InstructorID', 'AcademyID')
            ->wherePivot('IsEnabled', 1);
    }

    /**
     * Copied form Instructor so that generic "user" could
     * find relationships with the same AccountID
     */
    public function academiesMaster() {
        return $this->belongsToMany('App\Models\Academy', 'AcademyInstructors', 'InstructorID', 'AcademyID')
            ->wherePivot('IsMaster', 1);
    }
}
