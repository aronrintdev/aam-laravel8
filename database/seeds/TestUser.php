<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TestUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $faker->seed(4321);
        $paulineId = DB::table('Accounts')->insertGetId([
//            'AccountID'          => 1,
            'FirstName'          => 'Pauline',
            'LastName'           => 'Pro',
            'Email'              => 'pauline@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);
        $carlId = DB::table('Accounts')->insertGetId([
//            'AccountID'          => 2,
            'FirstName'          => 'Carl',
            'LastName'           => 'Customer',
            'Email'              => 'carl@customer.test',
            'PasswordHash'       => \Hash::make('password'),
        ]);
        $raviId = DB::table('Accounts')->insertGetId([
//            'AccountID'          => 3,
            'FirstName'          => 'Ravi',
            'LastName'           => 'Rabbi',
            'Email'              => 'ravi@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        $irisId = DB::table('Accounts')->insertGetId([
            'FirstName'          => 'Iris',
            'LastName'           => 'Instructor',
            'Email'              => 'iris@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        $samId = DB::table('Accounts')->insertGetId([
            'FirstName'          => 'Sam',
            'LastName'           => 'Shortstop',
            'Email'              => 'sam@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        $johnnyId = DB::table('Accounts')->insertGetId([
            'FirstName'          => 'Johnny',
            'LastName'           => 'Junior',
            'Email'              => 'johnny@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        $landonId = DB::table('Accounts')->insertGetId([
            'FirstName'          => 'Landon',
            'LastName'           => 'Leftfield',
            'Email'              => 'landon@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        $codyId = DB::table('Accounts')->insertGetId([
            'FirstName'          => 'Cody',
            'LastName'           => 'Catcher',
            'Email'              => 'cody@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        $oscarId = DB::table('Accounts')->insertGetId([
            'FirstName'          => 'Oscar',
            'LastName'           => 'Owner',
            'Email'              => 'oscar@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        $aprilId = DB::table('Accounts')->insertGetId([
            'FirstName'          => 'April',
            'LastName'           => 'Assistant',
            'Email'              => 'april@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $paulineId,
            'Title'        => 'Sr. Pro Teacher',
            'HeadShot'     => 'https://vos-media.nyc3.digitaloceanspaces.com/test/academy/72/726531f0084f2b7469188bbe54db21c03f912cc6-hs-1.png',
            'Biography'       => 'Pauline\'s Bio',
            'Philosophy'      => 'Pauline\'s Philosophy',
            'Accomplishments' => 'Pauline\'s Accomplishments',
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $raviId,
            'Title'        => 'Sr. Pro Instructor',
            'HeadShot'     => 'https://vos-media.nyc3.digitaloceanspaces.com/test/academy/a1/a134d13bc9fb824aa959c1aeeeb29b0560644292-hs-3.jpeg',
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $irisId,
            'Title'        => 'Sr. Pro Instructor',
            'HeadShot'     => 'https://vos-media.nyc3.digitaloceanspaces.com/test/academy/2e/2e0ff53cc34923793f91984a6321ec4214be2f21-hs-4.jpeg',
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $samId,
            'Title'        => 'Sr. Pro Instructor',
            'HeadShot'     => 'https://vos-media.nyc3.cdn.digitaloceanspaces.com/test.profile/sam-headshot-48.jpg',
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $johnnyId,
            'Title'        => 'Jr. Pro Instructor',
            'HeadShot'     => 'https://vos-media.nyc3.cdn.digitaloceanspaces.com/test.profile/johnny-headshot-51.jpg',
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $landonId,
            'Title'        => 'Outfield Instructor',
            'HeadShot'     => 'https://vos-media.nyc3.cdn.digitaloceanspaces.com/test.profile/landon-headshot-37.jpg',
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $codyId,
            'Title'        => 'Catching Instructor',
            'HeadShot'     => 'https://vos-media.nyc3.cdn.digitaloceanspaces.com/test.profile/cody-headshot-76.jpg',
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $oscarId,
            'Title'        => 'Sr. Pro Instructor',
            'HeadShot'     => 'https://vos-media.nyc3.digitaloceanspaces.com/test.profile/oscar-headshot-39.jpg',
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $aprilId,
            'Title'        => 'Asst. Instructor',
            'HeadShot'     => 'https://vos-media.nyc3.digitaloceanspaces.com/test.profile/april-headshot-38.jpg',
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'       => 'PPRO',
            'InstructorID'    => $paulineId,
            'IsMaster'        => 1,
            'IsEnabled'       => 1,
            'IsHidden'        => 0,
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'       => 'FORE',
            'InstructorID'    => $paulineId,
            'IsMaster'        => 0,
            'IsEnabled'       => 1,
            'IsHidden'        => 0,
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'       => 'FORE',
            'InstructorID'    => $oscarId,
            'IsMaster'        => 1,
            'IsEnabled'       => 1,
            'IsHidden'        => 0,
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'       => 'FORE',
            'InstructorID'    => $aprilId,
            'IsMaster'        => 0,
            'IsEnabled'       => 1,
            'IsHidden'        => 0,
        ]);


        DB::table('AcademyInstructors')->insert([
            'AcademyID'    => 'CTWO',
            'InstructorID' => $raviId,
            'IsMaster'     => 0,
            'IsEnabled'    => 1,
            'IsHidden'     => 0,
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'    => 'CTWO',
            'InstructorID' => $irisId,
            'IsMaster'     => 1,
            'IsEnabled'    => 1,
            'IsHidden'     => 0,
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'    => 'BALL',
            'InstructorID' => $samId,
            'IsMaster'     => 1,
            'IsEnabled'    => 1,
            'IsHidden'     => 0,
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'    => 'BALL',
            'InstructorID' => $johnnyId,
            'IsMaster'     => 0,
            'IsEnabled'    => 1,
            'IsHidden'     => 0,
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'    => 'BALL',
            'InstructorID' => $landonId,
            'IsMaster'     => 0,
            'IsEnabled'    => 1,
            'IsHidden'     => 0,
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'    => 'BALL',
            'InstructorID' => $codyId,
            'IsMaster'     => 0,
            'IsEnabled'    => 1,
            'IsHidden'     => 0,
        ]);

        DB::table('AcademyStudents')->insert([
            'AcademyID'    => 'PPRO',
            'AccountID'    => $carlId,
        ]);
        DB::table('InstructorStudentsMulti')->insert([
            'InstructorID'         => $paulineId,
            'AccountID'            => $carlId,
            'IsVerified'           => 1,
            'StudentVerifiedAt'    => \Carbon\Carbon::now(),
            'InstructorVerifiedAt' => \Carbon\Carbon::now(),
        ]);

        DB::table('AcademyStudents')->insert([
            'AcademyID'    => 'BALL',
            'AccountID'    => $carlId,
        ]);
        DB::table('InstructorStudentsMulti')->insert([
            'InstructorID'         => $samId,
            'AccountID'            => $carlId,
            'IsVerified'           => 1,
            'StudentVerifiedAt'    => \Carbon\Carbon::now(),
            'InstructorVerifiedAt' => \Carbon\Carbon::now(),
        ]);


        foreach (range(1,25) as $index) {
            $studentId = DB::table('Accounts')->insertGetId([
                'FirstName'          => $faker->firstName(),
                'LastName'           => $faker->lastName(),
                'Email'              => $faker->safeEmail(),
                'PasswordHash'       => \Hash::make('password'),
            ]);

            DB::table('AcademyStudents')->insert([
                'AcademyID'    => 'CTWO',
                'AccountID'    => $studentId,
            ]);
            DB::table('InstructorStudentsMulti')->insert([
                'InstructorID'         => $raviId,
                'AccountID'            => $studentId,
                'IsVerified'           => 1,
                'StudentVerifiedAt'    => \Carbon\Carbon::now(),
                'InstructorVerifiedAt' => \Carbon\Carbon::now(),
            ]);
        }

        #$fakerJa = Faker::create('ja_JP');
        foreach (range(1,11) as $index) {

            $studentId = DB::table('Accounts')->insertGetId([
                'FirstName'          => $faker->firstName(),
                'LastName'           => $faker->lastName(),
                'Email'              => $faker->safeEmail(),
                'PasswordHash'       => \Hash::make('password'),
            ]);

            DB::table('AcademyStudents')->insert([
                'AcademyID'    => 'PPRO',
                'AccountID'    => $studentId,
            ]);
            DB::table('InstructorStudentsMulti')->insert([
                'InstructorID'         => $paulineId,
                'AccountID'            => $studentId,
                'IsVerified'           => 1,
                'StudentVerifiedAt'    => \Carbon\Carbon::now(),
                'InstructorVerifiedAt' => \Carbon\Carbon::now(),
            ]);
        }

        //customers
        $gwenId = DB::table('Accounts')->insertGetId([
            'FirstName'          => 'Gwen',
            'LastName'           => 'Golfer',
            'Email'              => 'gwen@customer.test',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        $saraId = DB::table('Accounts')->insertGetId([
            'FirstName'          => 'Sara',
            'LastName'           => 'Student',
            'Email'              => 'sara@customer.test',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        DB::table('V1GolfPlus')->insert([
            'AccountID'      => $saraId,
            'CustID'         => 'Android',
            'SubID'          => null,
            'Active'         => 1,
            'Created'        => \Carbon\Carbon::now('UTC')->subDays(366),
            'StripeDate'     => null,
            'Unsubbed'       => null,
            'AndroidToken'   => null,
            'AndroidPackage' => 'v1_golf_plus_annual',
            'Trial'          => 0,
            'TrialStartDate' => null,
            'PlanType'       => null,
        ]);
    }
}
