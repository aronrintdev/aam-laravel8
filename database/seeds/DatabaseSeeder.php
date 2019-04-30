<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(SwingStatusIDsTableSeeder::class);
        $this->call(TestAcademyTableSeeder::class);
        $this->call(TestUser::class);
        $this->call(TestSwingSeeder::class);
    }
}
