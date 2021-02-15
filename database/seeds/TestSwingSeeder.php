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

        for ($z = 0; $z < 10; $z++) {
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
        for ($z = 0; $z < 10; $z++) {
            $videoPath = $faker->randomElement([
                'https://v1sports.com/SwingStore/1811131251493KRU518100.mp4',
                'https://dl5.webmfiles.org/big-buck-bunny_trailer.webm',
            ]);
            $analysisPath = $faker->randomElement([
                'https://vos-media.nyc3.cdn.digitaloceanspaces.com/test/analysis/ex1.mp4',
                'https://vos-media.nyc3.cdn.digitaloceanspaces.com/test/analysis/ex2.mp4',
            ]);
            $id = DB::table('Swings')->insertGetId([
                'AccountID'          => 2,
                'SwingStatusID'      => 3,
                'DateUploaded'       => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = 'America/New_York'),
                'Description'        => $faker->realText($maxNbChars=240),
                'SportID'            => 'GOLF',
                'VideoPath'          => $videoPath,
                'InstructorID'       => 1,
                'DateAccepted'       => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'America/New_York'),
                'DateAnalyzed'       => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'America/New_York'),
                'AnalysisPath'       => $analysisPath,
                'AcademyID'          => 'V1AC',
            ]);
        }
        for ($z = 0; $z < 10; $z++) {
            $analysisPath = $faker->randomElement([
                '190422225737FJ5V2349216.mp4',
                '190422225737FJ5V2349216.mp4',
            ]);
            $dateUploaded = $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = 'America/New_York');
            $id = DB::table('Swings')->insertGetId([
                'AccountID'          => 2,
                'SwingStatusID'      => 3,
                'DateUploaded'       => $dateUploaded,
                'Description'        => $faker->realText($maxNbChars=240),
                'SportID'            => 'GOLF',
                'VideoPath'          => $analysisPath,
                'InstructorID'       => 3,
                'DateAccepted'       => $dateUploaded->modify('+61 milliseconds'),
                'DateAnalyzed'       => $dateUploaded->modify('+601 milliseconds'),
                'AnalysisPath'       => $analysisPath,
                'AcademyID'          => 'SHYG',
            ]);
        }

        //broken swing analysis
        //
        $dateUploaded = $faker->dateTimeBetween($startDate = '-1 week', $endDate = 'now', $timezone = 'America/New_York');
        $id = DB::table('Swings')->insertGetId([
            'AccountID'          => 2,
            'SwingStatusID'      => 2,
            'DateUploaded'       => $dateUploaded,
            'Description'        => $faker->realText($maxNbChars=240),
            'SportID'            => 'GOLF',
            'VideoPath'          => 'https://vos-media.nyc3.cdn.digitaloceanspaces.com/test/analysis/ex1.mp4',
            'InstructorID'       => 3,
            'DateAccepted'       => $dateUploaded->modify('+61 milliseconds'),
            'DateAnalyzed'       => null,
            'AnalysisPath'       => null,
            'AcademyID'          => 'SHYG',
        ]);
        $id = DB::table('Swings')->insertGetId([
            'AccountID'          => 2,
            'SwingStatusID'      => 3,
            'DateUploaded'       => $dateUploaded,
            'Description'        => $faker->realText($maxNbChars=240),
            'SportID'            => 'GOLF',
            'VideoPath'          => '190422225737FJ5V2349216.mp4',
            'InstructorID'       => 3,
            'DateAccepted'       => $dateUploaded->modify('-6 days'),
            'DateAnalyzed'       => $dateUploaded,
            'AnalysisPath'       => '190422225737FJ5V2349216.mp4',
            'AcademyID'          => 'SHYG',
        ]);


        //random locker swings
        for ($z = 0; $z < 12; $z++) {
            $videoPath = $faker->randomElement([
                'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_portrait_720p_r60.mp4',
                'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_baseball_landscape_720p_r60.mp4',
                'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_golf_landscape_720p_r60.mp4',
                'https://vos-videos.nyc3.digitaloceanspaces.com/test/md-library/test_pattern_1080.mp4',
            ]);
            $id = DB::table('Swings')->insertGetId([
                'AccountID'          => $faker->randomElement([2, 47, 48]),
                'SwingStatusID'      => 0,
                'DateUploaded'       => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'America/New_York'),
                'Description'        => $faker->realText($maxNbChars=240),
                'SportID'            => 'GOLF',
                'VideoPath'          => $videoPath,
                'InstructorID'       => 0,
                'DateAccepted'       => NULL,
                'DateAnalyzed'       => NULL,
                'AnalysisPath'       => NULL,
                'AcademyID'          => '',
            ]);
        }

    }
}
