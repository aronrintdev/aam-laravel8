<?php

namespace App\Repositories;

use App\Models\Academy;
use App\Repositories\BaseRepository;

/**
 * Class AcademyRepository
 * @package App\Repositories
 * @version April 2, 2019, 10:04 pm UTC
*/

class AcademyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Academy::class;
    }
}
