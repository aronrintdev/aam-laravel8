<?php

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
        $instructorRepo = App::make(InstructorRepository::class);
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
            'SalesPerson' => $fake->word,
            'NotableStudents' => $fake->word,
            'ProCode' => $fake->randomDigitNotNull,
            'CourseAddress' => $fake->word,
            'FB_URL' => $fake->word,
            'HeadShot' => $fake->word,
            'TurnaroundDays' => $fake->word,
            'CourseWeb' => $fake->word,
            'PlayingLevel' => $fake->word,
            'Fee' => $fake->randomDigitNotNull,
            'SampleLesson' => $fake->word,
            'Philosophy' => $fake->word,
            'Founder' => $fake->word,
            'CourseProvince' => $fake->word,
            'PrivateFlag' => $fake->word,
            'FacultyEmail' => $fake->word,
            'PersonalWebImage' => $fake->word,
            'PGAMember' => $fake->word,
            'Available' => $fake->word,
            'CourseName' => $fake->word,
            'CourseCity' => $fake->word,
            'DiscountRate' => $fake->randomDigitNotNull,
            'CoursePhone' => $fake->word,
            'Title' => $fake->word,
            'CourseAddress2' => $fake->word,
            'FreeLessons' => $fake->randomDigitNotNull,
            'DiscountFee' => $fake->randomDigitNotNull,
            'Biography' => $fake->word,
            'CourseZip' => $fake->word,
            'ActionShot' => $fake->word,
            'SerialNo' => $fake->randomDigitNotNull,
            'AcademyID' => $fake->word,
            'PersonalWebLink' => $fake->word,
            'StartedTeaching' => $fake->date('Y-m-d H:i:s'),
            'CourseState' => $fake->word,
            'V1ProVersion' => $fake->word,
            'SetStudentCharge' => $fake->word,
            'Accomplishments' => $fake->word,
            'StartDate' => $fake->word,
            'SpecialtyCode' => $fake->randomDigitNotNull,
            'CourseCountry' => $fake->word,
            'SportID' => $fake->word,
            'V1GAProCode' => $fake->word
        ], $instructorFields);
    }
}
