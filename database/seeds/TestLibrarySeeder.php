<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TestLibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('DELETE FROM [Swings] WHERE AccountID=3233 or AccountID=260690');
        $faker = Faker::create();

        //models
        for ($z = 0; $z < 10; $z++) {
            $video = $faker->randomElement([
                ['GOLF', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_golf_landscape_720p_r60.mp4'],
                ['BASE', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_landscape_720p_r60.mp4'],
                ['GOLF', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_golf_portrait_1280p_r60.mp4'],
                ['BASE', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_portrait_1280p_r60.mp4'],
                ['BASE', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_portrait_1920p_r30.mp4'],
            ]);
            $sportId   = $video[0];
            $videoPath = $video[1];
            $id = DB::table('Swings')->insertGetId([
                'AccountID'          => 3233,
                'InstructorID'       => 1,
                'SwingStatusID'      => 0,
                'DateUploaded'       => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = 'America/New_York'),
                'Description'        => $faker->realText($maxNbChars=240),
                'SportID'            => $sportId,
                'VideoPath'          => $videoPath,
            ]);
        }

        //drills
        for ($z = 0; $z < 10; $z++) {
            $video = $faker->randomElement([
                ['GOLF', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_golf_landscape_720p_r60.mp4'],
                ['BASE', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_landscape_720p_r60.mp4'],
                ['GOLF', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_golf_portrait_1280p_r60.mp4'],
                ['BASE', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_portrait_1280p_r60.mp4'],
                ['BASE', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_portrait_1920p_r30.mp4'],
            ]);
            $sportId   = $video[0];
            $videoPath = $video[1];
            $id = DB::table('Swings')->insertGetId([
                'AccountID'          => 3233,
                'InstructorID'       => 3233,
                'SwingStatusID'      => 0,
                'DateUploaded'       => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = 'America/New_York'),
                'Description'        => $faker->realText($maxNbChars=240),
                'SportID'            => $sportId,
                'VideoPath'          => $videoPath,
            ]);
        }

        //plus models
        for ($z = 0; $z < 10; $z++) {
            $video = $faker->randomElement([
                ['GOLF', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_golf_landscape_720p_r60.mp4'],
                ['BASE', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_landscape_720p_r60.mp4'],
                ['GOLF', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_golf_portrait_1280p_r60.mp4'],
                ['BASE', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_portrait_1280p_r60.mp4'],
                ['BASE', 'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_portrait_1920p_r30.mp4'],
            ]);
            $sportId   = $video[0];
            $videoPath = $video[1];

            $id = DB::table('Swings')->insertGetId([
                'AccountID'          => 260690,
                'SwingStatusID'      => 0,
                'DateUploaded'       => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = 'America/New_York'),
                'Description'        => $faker->realText($maxNbChars=240),
                'SportID'            => $sportId,
                'VideoPath'          => $videoPath,
            ]);
        }
    }
}
