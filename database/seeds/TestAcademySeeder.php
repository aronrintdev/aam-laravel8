<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TestAcademyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        DB::statement('TRUNCATE TABLE [Academies]');
        $faker = Faker::create();
        $faker->seed(4321);
        DB::table('Academies')->insert([
            'AcademyID'          => 'V1AC',
            'AdminAccountID'     => 1,
            'Name'               => 'Golfers R Us',
            'Description'        => 'Golf with a giraffe',
            'SportID'            => 1,
            'BaseColor'          => 'CC9900',
            'BannerText'         => 'Powered By Docker SQL Server',
            'SampleLesson'       => 999,
            'Logo'               => 'foo.jpg',
        ]);

/**
CREATE TABLE `Academies` (
 `AcademyID` char(8) NOT NULL,
 `AdminAccountID` int(11) NOT NULL,
 `Name` varchar(50) NOT NULL,
 `Description` varchar(256) NOT NULL,
 `SportID` char(4) NOT NULL,
 `PrivateFlag` tinyint(1) NOT NULL DEFAULT '1',
 `BaseColor` char(6) DEFAULT NULL,
 `BaseColorMed` char(6) DEFAULT NULL,
 `BaseColorLt` char(6) DEFAULT NULL,
 `SelectedColor` char(6) DEFAULT NULL,
 `SelectedColorMed` char(6) DEFAULT NULL,
 `SelectedColorLt` char(6) DEFAULT NULL,
 `TopTextBaseColor` char(6) DEFAULT NULL,
 `TopTextSelectedColor` char(6) DEFAULT NULL,
 `TopTextFont` varchar(50) DEFAULT NULL,
 `BodyFont` varchar(50) DEFAULT NULL,
 `BodyText` char(6) DEFAULT NULL,
 `FrontPageText1` varchar(256) DEFAULT NULL,
 `FrontPageText2` varchar(256) DEFAULT NULL,
 `Logo` varchar(256) DEFAULT NULL,
 `Startup` varchar(64) DEFAULT NULL,
 `EmailBody` varchar(1) DEFAULT NULL,
 `LogInGraphic` varchar(256) DEFAULT NULL,
 `BGColor` char(6) DEFAULT 'FFFFFF',
 `LessonCharge` decimal(19,4) DEFAULT '1.0000',
 `Live` tinyint(1) DEFAULT '0',
 `BannerText` varchar(50) DEFAULT NULL,
 `StartDate` varchar(50) DEFAULT NULL,
 `EndDate` varchar(50) DEFAULT NULL,
 `AnnualRenewFee` decimal(19,4) DEFAULT '0.0000',
 `MinMonthlyBilling` decimal(19,4) DEFAULT '0.0000',
 `MinMonthlyLessonsInc` int(11) DEFAULT '0',
 `FreeLessons` int(11) DEFAULT '0',
 `BillingStatusID` int(11) DEFAULT NULL,
 `Notes` varchar(512) DEFAULT NULL,
 `SalesPerson` char(2) DEFAULT NULL,
 `CreditCard` char(16) DEFAULT NULL,
 `CreditCard_Name` varchar(50) DEFAULT NULL,
 `CreditCard_Exp` char(4) DEFAULT NULL,
 `ProAdv_Serial` varchar(50) DEFAULT NULL,
 `LessonThreshold` int(11) DEFAULT NULL,
 `PrePayedMonths` int(11) DEFAULT NULL,
 `SampleLesson` int(11) DEFAULT NULL,
 `IFrame_Width` int(11) DEFAULT NULL,
 `IFrame_Height` int(11) DEFAULT NULL,
 `HidePoweredBy` tinyint(1) DEFAULT NULL,
 `FB_URL` varchar(50) DEFAULT NULL,
 `FB_URL_Long` varchar(200) DEFAULT NULL,
 `ModelsPage` tinyint(1) DEFAULT NULL,
 `V1GA_Locker` tinyint(1) DEFAULT NULL,
 `DivideByThreshold` tinyint(1) DEFAULT NULL,
 `CreatedWebURL` varchar(50) DEFAULT NULL,
 `CreatedWebLogin` varchar(50) DEFAULT NULL,
 `CreatedWebPW` varchar(50) DEFAULT NULL,
 `SplitCommission` char(2) DEFAULT NULL,
 `ContactEmail` varchar(50) DEFAULT NULL,
 `PromoID` varchar(8) DEFAULT NULL,
 `PlayerPartnerLogos` tinyint(1) DEFAULT NULL,
 `FB_FanPage_ID` bigint(20) DEFAULT NULL,
 `FB_UserID` bigint(20) DEFAULT NULL,
 `FB_SessionKey` varchar(128) DEFAULT NULL,
 `YT_Login` varchar(50) DEFAULT NULL,
 `YT_Password` varchar(50) DEFAULT NULL,
 `TW_Login` varchar(50) DEFAULT NULL,
 `TW_Password` varchar(50) DEFAULT NULL,
 `SecondarySalesPerson` char(2) DEFAULT NULL,
 `AdamPaid` tinyint(1) DEFAULT '0' COMMENT '''this is now being used to flag if the contact email gets new student notifications',
 `SendAnalysisEmail` tinyint(1) DEFAULT '1',
 `SendMoveEmail` tinyint(1) DEFAULT '1',
 `HiddenFlag` tinyint(1) DEFAULT '0',
 `SecureFlag` tinyint(1) DEFAULT '1',
 `NotBuiltFlag` tinyint(1) DEFAULT NULL,
 `ContactName` varchar(50) DEFAULT NULL,
 `CommissionPercentage` int(11) DEFAULT '30',
 `CommissionPercentage_Overage` int(11) DEFAULT '10',
 `CommissionPercentage_YearPlus` int(11) DEFAULT '15',
 `IFrame_URL` varchar(128) DEFAULT NULL,
 `BG_LightDark` int(11) DEFAULT NULL,
 `YT_UserName` varchar(64) DEFAULT NULL,
 `DisplayV1Models` tinyint(1) DEFAULT '1',
 `DisplayV1Drills` tinyint(1) DEFAULT '1',
 `TW_Key` varchar(64) DEFAULT NULL,
 `TW_Secret` varchar(64) DEFAULT NULL,
 `Translate` tinyint(1) DEFAULT NULL,
 `DateAdded` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
 `FB_OAuth_Token` varchar(300) DEFAULT NULL,
 `AcademyCountry` varchar(2) DEFAULT NULL,
 `EndNotes` varchar(512) DEFAULT NULL,
 `YT_URL` varchar(128) DEFAULT NULL,
 `YT_ChannelFlag` tinyint(1) DEFAULT NULL,
 `MailChimpKey` varchar(64) DEFAULT NULL,
 `DateTraining` datetime(6) DEFAULT NULL,
 `DiscountFlag` tinyint(1) DEFAULT '0',
 `DateTrainingContact` datetime(6) DEFAULT NULL,
 `ContractPDF` varchar(8) DEFAULT NULL,
 `YT_Refresh` varchar(128) DEFAULT NULL,
 `DateLessonCaddy` datetime(6) DEFAULT NULL,
 `DateV1ProSoftware` datetime(6) DEFAULT NULL,
 `DateV1ProApp` datetime(6) DEFAULT NULL,
 `HashTagFlag` tinyint(1) NOT NULL DEFAULT '1',
 `SaveAsFlag` tinyint(1) NOT NULL DEFAULT '0',
 `RatingFlag` tinyint(1) NOT NULL DEFAULT '1',
 `DateHolidayEnds` datetime(6) DEFAULT NULL,
 PRIMARY KEY (`AcademyID`)
*/
    }
}
