<?php
namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Swing;
use App\Repositories\SwingRepository;

trait MakeAnalysisTrait
{
    /**
     * Create fake instance of Swing and save it in database
     *
     * @param array $accountAvatarFields
     * @return AccountAvatar
     */
    public function makeAnalysis($swingFields = [])
    {
        return tap($this->fakeAnalysis($swingFields), function($item) {
            $item->save();
        });
    }

    /**
     * Get fake instance of Analysis
     *
     * @param array $accountAvatarFields
     * @return Analysis
     */
    public function fakeAnalysis($accountAvatarFields = [])
    {
        return new Swing($this->fakeAnalysisData($accountAvatarFields));
    }

    /**
     * Get fake data of Analysis
     *
     * @param array $accountAvatarFields
     * @return array
     */
    public function fakeAnalysisData($modelFields = [])
    {
        $faker = Faker::create();
        $faker->seed(1234);

        $analysisPath = $faker->randomElement([
            '190422225737FJ5V2349216.mp4',
            '190422225737FJ5V2349216.mp4',
        ]);
        $dateUploaded = $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = 'America/New_York');
        return array_merge([
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
        ], $modelFields);
    }
}
