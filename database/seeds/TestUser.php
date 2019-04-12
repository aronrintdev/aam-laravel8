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
        DB::table('Accounts')->insert([
            'Password'           => 1,
            'FirstName'          => 'Pauline',
            'LastName'           => 'Pro',
            'Email'              => 'pauline@example.com',
            'InstructorID'       => 1,
            'PasswordHash'       => \Hash::make('password'),
        ]);
        DB::table('Accounts')->insert([
            'Password'           => 2,
            'FirstName'          => 'Carl',
            'LastName'           => 'Customer',
            'Email'              => 'carl@customer.test',
            'PasswordHash'       => \Hash::make('password'),
        ]);

        DB::table('AcademyInstructors')->insert([
            'AcademyID'    => 1,
            'InstructorID' => 1,
            'IsMaster'     => 1,
            'IsEnabled'    => 1,
            'IsHidden'     => 0

        ]);
    }
}
