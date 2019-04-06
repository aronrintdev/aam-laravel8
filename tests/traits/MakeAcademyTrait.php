<?php

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
        $academyRepo = App::make(AcademyRepository::class);
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
            'BaseColor' => $fake->word,
            'AdamPaid' => $fake->word,
            'BaseColorLt' => $fake->word,
            'MinMonthlyLessonsInc' => $fake->randomDigitNotNull,
            'DateHolidayEnds' => $fake->date('Y-m-d H:i:s'),
            'DisplayV1Models' => $fake->word,
            'YT_Password' => $fake->word,
            'Name' => $fake->word,
            'SendMoveEmail' => $fake->word,
            'HidePoweredBy' => $fake->word,
            'Logo' => $fake->word,
            'ContractPDF' => $fake->word,
            'Live' => $fake->word,
            'ProAdv_Serial' => $fake->word,
            'TW_Secret' => $fake->word,
            'YT_URL' => $fake->word,
            'CreatedWebURL' => $fake->word,
            'PrivateFlag' => $fake->word,
            'FB_UserID' => $fake->word,
            'SecondarySalesPerson' => $fake->word,
            'SampleLesson' => $fake->randomDigitNotNull,
            'DateTraining' => $fake->date('Y-m-d H:i:s'),
            'NotBuiltFlag' => $fake->word,
            'LogInGraphic' => $fake->word,
            'ModelsPage' => $fake->word,
            'EndDate' => $fake->word,
            'FB_OAuth_Token' => $fake->word,
            'PromoID' => $fake->word,
            'BillingStatusID' => $fake->randomDigitNotNull,
            'DivideByThreshold' => $fake->word,
            'SportID' => $fake->word,
            'BodyText' => $fake->word,
            'TW_Password' => $fake->word,
            'SelectedColorMed' => $fake->word,
            'MailChimpKey' => $fake->word,
            'FB_URL_Long' => $fake->word,
            'SecureFlag' => $fake->word,
            'DateLessonCaddy' => $fake->date('Y-m-d H:i:s'),
            'StartDate' => $fake->word,
            'DateAdded' => $fake->date('Y-m-d H:i:s'),
            'BaseColorMed' => $fake->word,
            'MinMonthlyBilling' => $fake->randomDigitNotNull,
            'CreatedWebPW' => $fake->word,
            'IFrame_URL' => $fake->word,
            'HashTagFlag' => $fake->word,
            'TopTextSelectedColor' => $fake->word,
            'IFrame_Height' => $fake->randomDigitNotNull,
            'DateTrainingContact' => $fake->date('Y-m-d H:i:s'),
            'SendAnalysisEmail' => $fake->word,
            'AdminAccountID' => $fake->randomDigitNotNull,
            'LessonCharge' => $fake->randomDigitNotNull,
            'CommissionPercentage' => $fake->randomDigitNotNull,
            'EndNotes' => $fake->word,
            'CreditCard' => $fake->word,
            'TW_Key' => $fake->word,
            'DateV1ProApp' => $fake->date('Y-m-d H:i:s'),
            'CreatedWebLogin' => $fake->word,
            'TopTextBaseColor' => $fake->word,
            'FB_FanPage_ID' => $fake->word,
            'EmailBody' => $fake->word,
            'DiscountFlag' => $fake->word,
            'V1GA_Locker' => $fake->word,
            'ContactName' => $fake->word,
            'AnnualRenewFee' => $fake->randomDigitNotNull,
            'PrePayedMonths' => $fake->randomDigitNotNull,
            'SalesPerson' => $fake->word,
            'SelectedColor' => $fake->word,
            'FreeLessons' => $fake->randomDigitNotNull,
            'ContactEmail' => $fake->word,
            'YT_UserName' => $fake->word,
            'RatingFlag' => $fake->word,
            'BodyFont' => $fake->word,
            'YT_Login' => $fake->word,
            'HiddenFlag' => $fake->word,
            'FrontPageText2' => $fake->word,
            'YT_Refresh' => $fake->word,
            'CreditCard_Exp' => $fake->word,
            'CommissionPercentage_YearPlus' => $fake->randomDigitNotNull,
            'YT_ChannelFlag' => $fake->word,
            'SplitCommission' => $fake->word,
            'BG_LightDark' => $fake->randomDigitNotNull,
            'SaveAsFlag' => $fake->word,
            'TopTextFont' => $fake->word,
            'FB_SessionKey' => $fake->word,
            'IFrame_Width' => $fake->randomDigitNotNull,
            'BGColor' => $fake->word,
            'CommissionPercentage_Overage' => $fake->randomDigitNotNull,
            'AcademyCountry' => $fake->word,
            'CreditCard_Name' => $fake->word,
            'DisplayV1Drills' => $fake->word,
            'PlayerPartnerLogos' => $fake->word,
            'Description' => $fake->word,
            'TW_Login' => $fake->word,
            'FrontPageText1' => $fake->word,
            'SelectedColorLt' => $fake->word,
            'Startup' => $fake->word,
            'FB_URL' => $fake->word,
            'DateV1ProSoftware' => $fake->date('Y-m-d H:i:s'),
            'BannerText' => $fake->word,
            'LessonThreshold' => $fake->randomDigitNotNull,
            'Translate' => $fake->word,
            'Notes' => $fake->word
        ], $academyFields);
    }
}
