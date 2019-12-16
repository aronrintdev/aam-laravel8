<?php

namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Academy;
use App\Repositories\AcademyRepository;

trait MakeAcademyTrait
{
    /**
     * Create fake instance of Academy and save it in database
     *
     * @param array $academyFields
     * @return Academy
     */
    public function makeAcademy($academyFields = [])
    {
        /** @var AcademyRepository $academyRepo */
        $academyRepo = \App::make(AcademyRepository::class);
        $theme = $this->fakeAcademyData($academyFields);
        return $academyRepo->create($theme);
    }

    /**
     * Get fake instance of Academy
     *
     * @param array $academyFields
     * @return Academy
     */
    public function fakeAcademy($academyFields = [])
    {
        return new Academy($this->fakeAcademyData($academyFields));
    }

    /**
     * Get fake data of Academy
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAcademyData($academyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'AcademyID' => strtoupper(substr($fake->word, 0, 4)),
            'AdminAccountID' => $fake->randomDigitNotNull,
            'Name' => $fake->word,
            'Description' => $fake->word,
            'SportID' => 'GOLF',
            'BaseColor' => substr($fake->hexcolor, -6),
            'AdamPaid' => $fake->boolean,
            'BaseColorLt' => substr($fake->hexcolor, -6),
            'MinMonthlyLessonsInc' => $fake->randomDigitNotNull,
            'DateHolidayEnds' => $fake->date('Y-m-d H:i:s.v'),
            'DisplayV1Models' => $fake->boolean,
            'DisplayV1Drills' => $fake->boolean,
            'YT_Password' => $fake->word,
            'SendMoveEmail' => $fake->boolean,
            'HidePoweredBy' => $fake->boolean,
            'Logo' => $fake->word,
            'ContractPDF' => '',
            'Live' => $fake->boolean,
            'ProAdv_Serial' => $fake->word,
            'TW_Secret' => $fake->word,
            'YT_URL' => $fake->word,
            'CreatedWebURL' => $fake->word,
            'PrivateFlag' => $fake->boolean,
            'FB_UserID' => $fake->randomDigitNotNull,
            'FB_FanPage_ID' => $fake->randomDigitNotNull,
            'SecondarySalesPerson' => substr($fake->word, 0, 2),
            'SampleLesson' => $fake->randomDigitNotNull,
            'DateTraining' => $fake->date('Y-m-d H:i:s.v'),
            'NotBuiltFlag' => $fake->boolean,
            'LogInGraphic' => $fake->word,
            'ModelsPage' => $fake->boolean,
            'EndDate' => $fake->word,
            'FB_OAuth_Token' => $fake->word,
            'PromoID' => substr($fake->word,0, 8),
            'BillingStatusID' => $fake->randomDigitNotNull,
            'DivideByThreshold' => $fake->boolean,
            'BodyText' => 'na    ',
            'TW_Password' => $fake->word,
            'SelectedColorMed' => substr($fake->hexcolor, -6),
            'MailChimpKey' => $fake->word,
            'FB_URL_Long' => $fake->word,
            'SecureFlag' => $fake->boolean,
            'DateLessonCaddy' => $fake->date('Y-m-d H:i:s.v'),
            'StartDate' => $fake->word,
            'DateAdded' => $fake->date('Y-m-d H:i:s.v'),
            'BaseColorMed' => substr($fake->hexcolor, -6),
            'MinMonthlyBilling' => $fake->randomDigitNotNull,
            'CreatedWebPW' => $fake->word,
            'IFrame_URL' => $fake->word,
            'HashTagFlag' => $fake->boolean,
            'TopTextSelectedColor' => substr($fake->hexcolor, -6),
            'IFrame_Height' => $fake->randomDigitNotNull,
            'DateTrainingContact' => $fake->date('Y-m-d H:i:s.v'),
            'SendAnalysisEmail' => $fake->boolean,
            'LessonCharge' => $fake->randomDigitNotNull,
            'CommissionPercentage' => $fake->randomDigitNotNull,
            'EndNotes' => $fake->word,
            'CreditCard' => null,
            'CreditCard_Exp' => null,
            'TW_Key' => '',
            'DateV1ProApp' => $fake->date('Y-m-d H:i:s.v'),
            'CreatedWebLogin' => $fake->word,
            'TopTextBaseColor' => substr($fake->hexcolor, -6),
            'EmailBody' => null,
            'DiscountFlag' => $fake->boolean,
            'V1GA_Locker' => $fake->boolean,
            'ContactName' => $fake->word,
            'AnnualRenewFee' => $fake->randomDigitNotNull,
            'PrePayedMonths' => $fake->randomDigitNotNull,
            'SalesPerson' => substr($fake->word, 0, 2),
            'SelectedColorLt' => substr($fake->hexcolor, -6),
            'SelectedColor' => substr($fake->hexcolor, -6),
            'BGColor'       => substr($fake->hexcolor, -6),
            'FreeLessons' => $fake->randomDigitNotNull,
            'ContactEmail' => $fake->word,
            'RatingFlag' => $fake->boolean,
            'BodyFont' => $fake->word,
            'YT_Login' => $fake->word,
            'HiddenFlag' => $fake->boolean,
            'FrontPageText2' => $fake->word,
            'YT_Refresh' => $fake->word,
            'YT_UserName' => $fake->word,
            'YT_ChannelFlag' => $fake->boolean,
            'CommissionPercentage_YearPlus' => $fake->randomDigitNotNull,
            'SplitCommission' => null,
            'BG_LightDark' => $fake->randomDigitNotNull,
            'SaveAsFlag' => $fake->boolean,
            'TopTextFont' => $fake->word,
            'FB_SessionKey' => $fake->word,
            'IFrame_Width' => $fake->randomDigitNotNull,
            'CommissionPercentage_Overage' => $fake->randomDigitNotNull,
            'AcademyCountry' => $fake->countryCode,
            'CreditCard_Name' => '',
            'PlayerPartnerLogos' => $fake->boolean,
            'TW_Login' => $fake->word,
            'FrontPageText1' => $fake->word,
            'Startup' => $fake->word,
            'FB_URL' => $fake->word,
            'DateV1ProSoftware' => $fake->date('Y-m-d H:i:s.v'),
            'BannerText' => $fake->word,
            'LessonThreshold' => $fake->randomDigitNotNull,
            'Translate' => $fake->boolean,
            'Notes' => $fake->word
        ], $academyFields);
    }
}
