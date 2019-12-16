<?php

namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Instructor;
use App\Repositories\InstructorRepository;

trait MakeInstructorTrait
{
    /**
     * Create fake instance of Instructor and save it in database
     *
     * @param array $instructorFields
     * @return Instructor
     */
    public function makeInstructor($instructorFields = [])
    {
        /** @var InstructorRepository $instructorRepo */
        $instructorRepo = \App::make(InstructorRepository::class);
        $theme = $this->fakeInstructorData($instructorFields);
        return $instructorRepo->create($theme);
    }

    /**
     * Get fake instance of Instructor
     *
     * @param array $instructorFields
     * @return Instructor
     */
    public function fakeInstructor($instructorFields = [])
    {
        return new Instructor($this->fakeInstructorData($instructorFields));
    }

    /**
     * Get fake data of Instructor
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInstructorData($instructorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'InstructorID' => $fake->numberBetween(6, 20),
            'SalesPerson' => null,
            'NotableStudents' => $fake->word,
            'ProCode' => $fake->randomDigitNotNull,
            'CourseAddress' => $fake->word,
            'FB_URL' => $fake->word,
            'HeadShot' => $fake->word,
            'TurnaroundDays' => $fake->randomDigitNotNull,
            'CourseWeb' => $fake->word,
            'PlayingLevel' => $fake->randomDigitNotNull,
            'Fee' => $fake->randomDigitNotNull,
            'SampleLesson' => $fake->word,
            'Philosophy' => $fake->word,
            'Founder' => $fake->randomDigitNotNull,
            'CourseProvince' => $fake->word,
            'PrivateFlag' => $fake->randomDigitNotNull,
            'FacultyEmail' => $fake->word,
            'PersonalWebImage' => $fake->word,
            'PGAMember' => $fake->boolean,
            'Available' => $fake->randomDigitNotNull,
            'CourseName' => $fake->word,
            'CourseCity' => $fake->word,
            'DiscountRate' => $fake->randomDigitNotNull,
            'CoursePhone' => $fake->word,
            'Title' => $fake->word,
            'CourseAddress2' => $fake->word,
            'FreeLessons' => $fake->boolean,
            'DiscountFee' => $fake->randomDigitNotNull,
            'Biography' => $fake->word,
            'CourseZip' => substr($fake->word, 0, 5),
            'ActionShot' => $fake->word,
            'SerialNo' => $fake->randomDigitNotNull,
            'AcademyID' => substr($fake->word, 0, 4),
            'PersonalWebLink' => $fake->word,
            'StartedTeaching' => $fake->date('Y-m-d H:i:s.v'),
            'CourseState' => substr($fake->word, 0, 2),
            'V1ProVersion' => null,
            'SetStudentCharge' => $fake->boolean,
            'Accomplishments' => $fake->word,
            'StartDate' => null,
            'SpecialtyCode' => $fake->randomDigitNotNull,
            'CourseCountry' => $fake->word,
            'SportID' => 'GOLF',
            'V1GAProCode' => substr($fake->word, 0, 4)
        ], $instructorFields);
    }
}
