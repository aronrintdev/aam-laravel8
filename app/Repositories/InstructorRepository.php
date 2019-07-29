<?php

namespace App\Repositories;

use App\Models\Instructor;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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

    /**
     * select * FROM [Instructors]
     * inner join [Accounts] on [Instructors].[InstructorID] = [Accounts].[AccountID]
     * inner join [AcademyInstructors] on [Accounts].[AccountID] = [AcademyInstructors].[InstructorID]
     * where [AcademyInstructors].[AcademyID] = 'v1ac'
     */
    public function forAcademy($academyId, $search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $columns[] = 'Accounts.AccountID';
        $query = $this->model->newQuery();
        $query->where('AcademyInstructors.AcademyID', '=', $academyId);
        if (count($search)) {
            foreach($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    if (is_array($value)) {
                        $query->whereIn($key, $value);
                    } else {
                        $query->where($key, $value);
                    }
                }
            }
        }

        $query->join('Accounts',           'Instructors.InstructorID', 'Accounts.AccountID');
        $query->join('AcademyInstructors', 'Accounts.AccountID', 'AcademyInstructors.InstructorID');
        return $query->get($columns);
    }


    /**
     * select * FROM [Accounts]
     * inner join [InstructorStudents] on [Accounts].[AccountID] = [InstructorStudents].[AccountID]
     * where [Instructors].[InstructorID] = '$instructorId'
     */
    public function students($instructorId, $skip = null, $limit = null, $columns = ['*'])
    {
        $columns = ['Accounts.*'];
        //$query = $this->model->newQuery();
        $query = (new \App\Models\Account())->newQuery();
        $query->where('InstructorStudents.InstructorID', '=', $instructorId);
        $query->join('InstructorStudents',           'InstructorStudents.AccountID', 'Accounts.AccountID');
        return $query->get($columns);
    }

    public function totalStudents($instructorId)
    {
        $columns = [DB::raw('COUNT(*) as total_count')];
        //$query = $this->model->newQuery();
        $query = (new \App\Models\Account())->newQuery();
        $query->where('InstructorStudents.InstructorID', '=', $instructorId);
        $query->join('InstructorStudents',           'InstructorStudents.AccountID', 'Accounts.AccountID');

        //get is different than select
        $results = $query->select($columns);

        return !empty($results) ? $results->first()->total_count : 0;
    }
}
