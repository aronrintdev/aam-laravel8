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
        DB::statement('TRUNCATE TABLE [Accounts]');
        DB::statement('TRUNCATE TABLE [AcademyInstructors]');
        $faker = Faker::create();
        $faker->seed(4321);
        $paulineId = DB::table('Accounts')->insertGetId([
//            'AccountID'          => 1,
            'FirstName'          => 'Pauline',
            'LastName'           => 'Pro',
            'Email'              => 'pauline@example.com',
            'InstructorID'       => 2,
            'PasswordHash'       => \Hash::make('password'),
        ]);
        $carlId = DB::table('Accounts')->insertGetId([
//            'AccountID'          => 2,
            'FirstName'          => 'Carl',
            'LastName'           => 'Customer',
            'Email'              => 'carl@customer.test',
            'PasswordHash'       => \Hash::make('password'),
        ]);
        $shyId = DB::table('Accounts')->insertGetId([
//            'AccountID'          => 3,
            'FirstName'          => 'Shy',
            'LastName'           => 'Guy',
            'Email'              => 'shy@example.com',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $paulineId,
        ]);

        DB::table('Instructors')->insert([
            'AcademyID'    => '',
            'InstructorID' => $shyId,
        ]);


        DB::table('AcademyInstructors')->insert([
            'AcademyID'    => 'V1AC',
            'InstructorID' => $paulineId,
            'IsMaster'     => 1,
            'IsEnabled'    => 1,
            'IsHidden'     => 0
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'    => 'SHYG',
            'InstructorID' => $shyId,
            'IsMaster'     => 1,
            'IsEnabled'    => 1,
            'IsHidden'     => 0
        ]);

        DB::table('AcademyStudents')->insert([
            'AcademyID'    => 'V1AC',
            'AccountID'    => $carlId,
        ]);
        DB::table('AcademyStudents')->insert([
            'AcademyID'    => 'SHYG',
            'AccountID'    => $carlId,
        ]);
    }
}
