<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TestSwingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('TRUNCATE TABLE [Swings]');
        $faker = Faker::create();
        $faker->seed(4321);

        for ($z = 0; $z < 20; $z++) {
            $videoPath = $faker->randomElement([
                'https://v1sports.com/SwingStore/1811131251493KRU518100.mp4',
                'https://dl5.webmfiles.org/big-buck-bunny_trailer.webm',
            ]);
            $id = DB::table('Swings')->insertGetId([
                'AccountID'          => 2,
                'SwingStatusID'      => 0,
                'DateUploaded'       => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = 'America/New_York'),
                'Description'        => $faker->realText($maxNbChars=240),
                'SportID'            => 'GOLF',
                'VideoPath'          => $videoPath,
            ]);
        }
    }
}
