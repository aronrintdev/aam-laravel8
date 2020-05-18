<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *   schema="Academy",
 *   required={""},
 *   @OA\Property(
 *     property="BaseColor",
 *     description="BaseColor",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="AdamPaid",
 *     description="AdamPaid",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="BaseColorLt",
 *     description="BaseColorLt",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="MinMonthlyLessonsInc",
 *     description="MinMonthlyLessonsInc",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="DisplayV1Models",
 *     description="DisplayV1Models",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="YT_Password",
 *     description="YT_Password",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Name",
 *     description="Name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SendMoveEmail",
 *     description="SendMoveEmail",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="HidePoweredBy",
 *     description="HidePoweredBy",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="Logo",
 *     description="Logo",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="ContractPDF",
 *     description="ContractPDF",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Live",
 *     description="Live",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="ProAdv_Serial",
 *     description="ProAdv_Serial",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="TW_Secret",
 *     description="TW_Secret",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="YT_URL",
 *     description="YT_URL",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CreatedWebURL",
 *     description="CreatedWebURL",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="PrivateFlag",
 *     description="PrivateFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="FB_UserID",
 *     description="FB_UserID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="SecondarySalesPerson",
 *     description="SecondarySalesPerson",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SampleLesson",
 *     description="SampleLesson",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="NotBuiltFlag",
 *     description="NotBuiltFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="LogInGraphic",
 *     description="LogInGraphic",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="ModelsPage",
 *     description="ModelsPage",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="EndDate",
 *     description="EndDate",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FB_OAuth_Token",
 *     description="FB_OAuth_Token",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="PromoID",
 *     description="PromoID",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BillingStatusID",
 *     description="BillingStatusID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="DivideByThreshold",
 *     description="DivideByThreshold",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="SportID",
 *     description="SportID",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BodyText",
 *     description="BodyText",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="TW_Password",
 *     description="TW_Password",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SelectedColorMed",
 *     description="SelectedColorMed",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="MailChimpKey",
 *     description="MailChimpKey",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FB_URL_Long",
 *     description="FB_URL_Long",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SecureFlag",
 *     description="SecureFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="StartDate",
 *     description="StartDate",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BaseColorMed",
 *     description="BaseColorMed",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="MinMonthlyBilling",
 *     description="MinMonthlyBilling",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CreatedWebPW",
 *     description="CreatedWebPW",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="IFrame_URL",
 *     description="IFrame_URL",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="HashTagFlag",
 *     description="HashTagFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="TopTextSelectedColor",
 *     description="TopTextSelectedColor",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="IFrame_Height",
 *     description="IFrame_Height",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="SendAnalysisEmail",
 *     description="SendAnalysisEmail",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="AdminAccountID",
 *     description="AdminAccountID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="LessonCharge",
 *     description="LessonCharge",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CommissionPercentage",
 *     description="CommissionPercentage",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="EndNotes",
 *     description="EndNotes",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CreditCard",
 *     description="CreditCard",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="TW_Key",
 *     description="TW_Key",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CreatedWebLogin",
 *     description="CreatedWebLogin",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="TopTextBaseColor",
 *     description="TopTextBaseColor",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FB_FanPage_ID",
 *     description="FB_FanPage_ID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="EmailBody",
 *     description="EmailBody",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="DiscountFlag",
 *     description="DiscountFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="V1GA_Locker",
 *     description="V1GA_Locker",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="ContactName",
 *     description="ContactName",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="AnnualRenewFee",
 *     description="AnnualRenewFee",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="PrePayedMonths",
 *     description="PrePayedMonths",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="SalesPerson",
 *     description="SalesPerson",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SelectedColor",
 *     description="SelectedColor",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FreeLessons",
 *     description="FreeLessons",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="ContactEmail",
 *     description="ContactEmail",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="YT_UserName",
 *     description="YT_UserName",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="RatingFlag",
 *     description="RatingFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="BodyFont",
 *     description="BodyFont",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="YT_Login",
 *     description="YT_Login",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="HiddenFlag",
 *     description="HiddenFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="FrontPageText2",
 *     description="FrontPageText2",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="YT_Refresh",
 *     description="YT_Refresh",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CreditCard_Exp",
 *     description="CreditCard_Exp",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CommissionPercentage_YearPlus",
 *     description="CommissionPercentage_YearPlus",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="YT_ChannelFlag",
 *     description="YT_ChannelFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="SplitCommission",
 *     description="SplitCommission",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BG_LightDark",
 *     description="BG_LightDark",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="SaveAsFlag",
 *     description="SaveAsFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="TopTextFont",
 *     description="TopTextFont",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FB_SessionKey",
 *     description="FB_SessionKey",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="IFrame_Width",
 *     description="IFrame_Width",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="AcademyID",
 *     description="AcademyID",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BGColor",
 *     description="BGColor",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CommissionPercentage_Overage",
 *     description="CommissionPercentage_Overage",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="AcademyCountry",
 *     description="AcademyCountry",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CreditCard_Name",
 *     description="CreditCard_Name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="DisplayV1Drills",
 *     description="DisplayV1Drills",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="PlayerPartnerLogos",
 *     description="PlayerPartnerLogos",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="Description",
 *     description="Description",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="TW_Login",
 *     description="TW_Login",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FrontPageText1",
 *     description="FrontPageText1",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SelectedColorLt",
 *     description="SelectedColorLt",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Startup",
 *     description="Startup",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FB_URL",
 *     description="FB_URL",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BannerText",
 *     description="BannerText",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="LessonThreshold",
 *     description="LessonThreshold",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="Translate",
 *     description="Translate",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="Notes",
 *     description="Notes",
 *     type="string"
 *   )
 * )
 */

class Academy extends Model
{
#    use SoftDeletes;

    public $table = 'Academies';
    
    public $timestamps = false;
    #const CREATED_AT = 'created_at';
    #const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'AcademyID';
    public $incrementing = false;
    public $keyType = 'string';

    public $fillable = [
        'BaseColor',
        'AdamPaid',
        'BaseColorLt',
        'MinMonthlyLessonsInc',
        'DateHolidayEnds',
        'DisplayV1Models',
        'YT_Password',
        'Name',
        'SendMoveEmail',
        'HidePoweredBy',
        'Logo',
        'ContractPDF',
        'Live',
        'ProAdv_Serial',
        'TW_Secret',
        'YT_URL',
        'CreatedWebURL',
        'PrivateFlag',
        'FB_UserID',
        'SecondarySalesPerson',
        'SampleLesson',
        'DateTraining',
        'NotBuiltFlag',
        'LogInGraphic',
        'ModelsPage',
        'EndDate',
        'FB_OAuth_Token',
        'PromoID',
        'BillingStatusID',
        'DivideByThreshold',
        'SportID',
        'BodyText',
        'TW_Password',
        'SelectedColorMed',
        'MailChimpKey',
        'FB_URL_Long',
        'SecureFlag',
        'DateLessonCaddy',
        'StartDate',
        'DateAdded',
        'BaseColorMed',
        'MinMonthlyBilling',
        'CreatedWebPW',
        'IFrame_URL',
        'HashTagFlag',
        'TopTextSelectedColor',
        'IFrame_Height',
        'DateTrainingContact',
        'SendAnalysisEmail',
        'AdminAccountID',
        'LessonCharge',
        'CommissionPercentage',
        'EndNotes',
        'CreditCard',
        'TW_Key',
        'DateV1ProApp',
        'CreatedWebLogin',
        'TopTextBaseColor',
        'FB_FanPage_ID',
        'EmailBody',
        'DiscountFlag',
        'V1GA_Locker',
        'ContactName',
        'AnnualRenewFee',
        'PrePayedMonths',
        'SalesPerson',
        'SelectedColor',
        'FreeLessons',
        'ContactEmail',
        'YT_UserName',
        'RatingFlag',
        'BodyFont',
        'YT_Login',
        'HiddenFlag',
        'FrontPageText2',
        'YT_Refresh',
        'CreditCard_Exp',
        'CommissionPercentage_YearPlus',
        'YT_ChannelFlag',
        'SplitCommission',
        'BG_LightDark',
        'SaveAsFlag',
        'TopTextFont',
        'FB_SessionKey',
        'IFrame_Width',
        'BGColor',
        'CommissionPercentage_Overage',
        'AcademyCountry',
        'CreditCard_Name',
        'DisplayV1Drills',
        'PlayerPartnerLogos',
        'Description',
        'TW_Login',
        'FrontPageText1',
        'SelectedColorLt',
        'Startup',
        'FB_URL',
        'DateV1ProSoftware',
        'BannerText',
        'LessonThreshold',
        'Translate',
        'Notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'BaseColor' => 'string',
        'AdamPaid' => 'boolean',
        'BaseColorLt' => 'string',
        'MinMonthlyLessonsInc' => 'integer',
        'DisplayV1Models' => 'boolean',
        'YT_Password' => 'string',
        'Name' => 'string',
        'SendMoveEmail' => 'boolean',
        'HidePoweredBy' => 'boolean',
        'Logo' => 'string',
        'ContractPDF' => 'string',
        'Live' => 'boolean',
        'ProAdv_Serial' => 'string',
        'TW_Secret' => 'string',
        'YT_URL' => 'string',
        'CreatedWebURL' => 'string',
        'PrivateFlag' => 'boolean',
        'FB_UserID' => 'integer',
        'SecondarySalesPerson' => 'string',
        'SampleLesson' => 'integer',
        'NotBuiltFlag' => 'boolean',
        'LogInGraphic' => 'string',
        'ModelsPage' => 'boolean',
        'EndDate' => 'string',
        'FB_OAuth_Token' => 'string',
        'PromoID' => 'string',
        'BillingStatusID' => 'integer',
        'DivideByThreshold' => 'boolean',
        'SportID' => 'string',
        'BodyText' => 'string',
        'TW_Password' => 'string',
        'SelectedColorMed' => 'string',
        'MailChimpKey' => 'string',
        'FB_URL_Long' => 'string',
        'SecureFlag' => 'boolean',
        'StartDate' => 'string',
        'BaseColorMed' => 'string',
        'MinMonthlyBilling' => 'integer',
        'CreatedWebPW' => 'string',
        'IFrame_URL' => 'string',
        'HashTagFlag' => 'boolean',
        'TopTextSelectedColor' => 'string',
        'IFrame_Height' => 'integer',
        'SendAnalysisEmail' => 'boolean',
        'AdminAccountID' => 'integer',
        'LessonCharge' => 'integer',
        'CommissionPercentage' => 'integer',
        'EndNotes' => 'string',
        'CreditCard' => 'string',
        'TW_Key' => 'string',
        'CreatedWebLogin' => 'string',
        'TopTextBaseColor' => 'string',
        'FB_FanPage_ID' => 'integer',
        'EmailBody' => 'string',
        'DiscountFlag' => 'boolean',
        'V1GA_Locker' => 'boolean',
        'ContactName' => 'string',
        'AnnualRenewFee' => 'integer',
        'PrePayedMonths' => 'integer',
        'SalesPerson' => 'string',
        'SelectedColor' => 'string',
        'FreeLessons' => 'integer',
        'ContactEmail' => 'string',
        'YT_UserName' => 'string',
        'RatingFlag' => 'boolean',
        'BodyFont' => 'string',
        'YT_Login' => 'string',
        'HiddenFlag' => 'boolean',
        'FrontPageText2' => 'string',
        'YT_Refresh' => 'string',
        'CreditCard_Exp' => 'string',
        'CommissionPercentage_YearPlus' => 'integer',
        'YT_ChannelFlag' => 'boolean',
        'SplitCommission' => 'string',
        'BG_LightDark' => 'integer',
        'SaveAsFlag' => 'boolean',
        'TopTextFont' => 'string',
        'FB_SessionKey' => 'string',
        'IFrame_Width' => 'integer',
        'AcademyID' => 'string',
        'BGColor' => 'string',
        'CommissionPercentage_Overage' => 'integer',
        'AcademyCountry' => 'string',
        'CreditCard_Name' => 'string',
        'DisplayV1Drills' => 'boolean',
        'PlayerPartnerLogos' => 'boolean',
        'Description' => 'string',
        'TW_Login' => 'string',
        'FrontPageText1' => 'string',
        'SelectedColorLt' => 'string',
        'Startup' => 'string',
        'FB_URL' => 'string',
        'BannerText' => 'string',
        'LessonThreshold' => 'integer',
        'Translate' => 'boolean',
        'Notes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Name' => 'required',
        'PrivateFlag' => 'required',
        'SportID' => 'required',
        'HashTagFlag' => 'required',
        'AdminAccountID' => 'required',
        'RatingFlag' => 'required',
        'SaveAsFlag' => 'required',
        //'AcademyID' => 'required',
        'Description' => 'required'
    ];

    
    public function getAcademyIDAttribute($value) {
        return trim($value);
    }

    public function students() {
        return $this->belongsToMany('App\Models\Account', 'AcademyStudents', 'AcademyID', 'AccountID');
    }
}
