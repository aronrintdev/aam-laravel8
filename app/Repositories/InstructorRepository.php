<?php

namespace App\Repositories;

use App\Models\Instructor;
use App\Repositories\BaseRepository;

/**
 * Class InstructorRepository
 * @package App\Repositories
 * @version April 2, 2019, 10:19 pm UTC
*/

class InstructorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'SalesPerson',
        'NotableStudents',
        'ProCode',
        'CourseAddress',
        'FB_URL',
        'HeadShot',
        'TurnaroundDays',
        'CourseWeb',
        'PlayingLevel',
        'Fee',
        'SampleLesson',
        'Philosophy',
        'Founder',
        'CourseProvince',
        'PrivateFlag',
        'FacultyEmail',
        'PersonalWebImage',
        'PGAMember',
        'Available',
        'CourseName',
        'CourseCity',
        'DiscountRate',
        'CoursePhone',
        'Title',
        'CourseAddress2',
        'FreeLessons',
        'DiscountFee',
        'Biography',
        'CourseZip',
        'ActionShot',
        'SerialNo',
        'AcademyID',
        'PersonalWebLink',
        'StartedTeaching',
        'CourseState',
        'V1ProVersion',
        'SetStudentCharge',
        'Accomplishments',
        'StartDate',
        'SpecialtyCode',
        'CourseCountry',
        'SportID',
        'V1GAProCode'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Instructor::class;
    }
}
