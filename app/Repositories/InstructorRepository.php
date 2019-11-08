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
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['Instructors.*'])
    {
        $query = $this->model->newQuery();

        $query->join('Accounts',           'Instructors.InstructorID', 'Accounts.AccountID');
        return $query->find($id, $columns);
    }


    public function all($search = [], $skip = null, $limit = null, $columns = ['Instructors.*'])
    {
        $query = $this->model->newQuery();
        $query->join('Accounts',           'Instructors.InstructorID', 'Accounts.AccountID');

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

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query->get($columns);
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
        $query->where('AcademyInstructors.IsEnabled', '1');

        $query->join('Accounts',           'Instructors.InstructorID', 'Accounts.AccountID');
        $query->join('AcademyInstructors', 'Accounts.AccountID', 'AcademyInstructors.InstructorID');
        return $query->get($columns);
    }


    /**
     * @param bool $includeAcademy  Include students connected only to the academy
     *
     * select * FROM [Accounts]
     * inner join [InstructorStudentsMulti] on [Accounts].[AccountID] = [InstructorStudentsMulti].[AccountID]
     * where [Instructors].[InstructorID] = '$instructorId'
     */
    public function students($instructorId, $includeAcademy=true, $filterStudentIds=[], $skip = null, $limit = null, $columns = ['*'])
    {
        $columns = ['Accounts.AccountID', 'Accounts.FirstName', 'Accounts.LastName', 'Accounts.Email', 'Accounts.DateOpened', 'InstructorStudentsMulti.CreatedAt as PickedAt'];
        $groups  = ['Accounts.AccountID', 'Accounts.FirstName', 'Accounts.LastName', 'Accounts.Email', 'Accounts.DateOpened', 'InstructorStudentsMulti.CreatedAt'];
        $query = (new \App\Models\Account())->newQuery();
        $query->where('InstructorStudentsMulti.InstructorID', '=', $instructorId);
        $query->where('InstructorStudentsMulti.IsVerified', '=', '1');
        if (!empty($filterStudentIds)) {
            $query->whereIn('Accounts.AccountID', $filterStudentIds);
        }
        if ($includeAcademy) {
            $query->leftjoin('InstructorStudentsMulti',           function($j) use($instructorId) {
                $j->on('InstructorStudentsMulti.AccountID', '=', 'Accounts.AccountID');
                $j->on('InstructorStudentsMulti.InstructorID', '=', \DB::raw($instructorId));
            });

            $columns[] = 'AcademyStudents.CreatedAt as JoinedAt';
            $groups[]  = 'AcademyStudents.CreatedAt';
            $query->leftjoin('AcademyStudents',              function($j) {
                $j->on('AcademyStudents.AccountID', '=', 'Accounts.AccountID');
            });

            $query->join('AcademyInstructors',          function($j) use ($instructorId){
                $j->on('AcademyStudents.AcademyID', '=', 'AcademyInstructors.AcademyID');
                $j->on('AcademyInstructors.InstructorID', '=', \DB::raw($instructorId));
            });

            $query->orWhere('AcademyInstructors.InstructorID', '=', $instructorId);
        } else {
            $query->join('InstructorStudentsMulti',           function($j) use($instructorId) {
                $j->on('InstructorStudentsMulti.AccountID', '=', 'Accounts.AccountID');
                $j->on('InstructorStudentsMulti.InstructorID', '=', \DB::raw($instructorId));
            });
        }

        $query->groupBy($groups);

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query->get($columns);
    }

    /**
     * @param bool $includeAcademy  Count students connected only to the academy
     */
    public function totalStudents($instructorId, $includeAcademy=true, $filterStudentIds=[])
    {
        $columns = [DB::raw('COUNT( DISTINCT Accounts.AccountID) as total_count')];
        //$query = $this->model->newQuery();
        //$query = (new \App\Models\Account())->newQuery();
        $query = DB::table('Accounts');
        $query->where('InstructorStudentsMulti.InstructorID', '=', $instructorId);
        if (!empty($filterStudentIds)) {
            $query->whereIn('Accounts.AccountID', $filterStudentIds);
        }
        $query->leftjoin('InstructorStudentsMulti',           function($j) use($instructorId) {
            $j->on('InstructorStudentsMulti.AccountID', '=', 'Accounts.AccountID');
            $j->on('InstructorStudentsMulti.InstructorID', '=', \DB::raw($instructorId));
        });

        if ($includeAcademy) {
            $query->leftjoin('AcademyStudents',              function($j) {
                $j->on('AcademyStudents.AccountID', '=', 'Accounts.AccountID');
            });

            $query->join('AcademyInstructors',          function($j) use ($instructorId){
                $j->on('AcademyStudents.AcademyID', '=', 'AcademyInstructors.AcademyID');
                $j->on('AcademyInstructors.InstructorID', '=', \DB::raw($instructorId));
            });

            $query->orWhere('AcademyInstructors.InstructorID', '=', \DB::raw($instructorId));
        }
        //$query->groupBy(['Accounts.AccountID']);

        //get is different than select
        $results = $query->select($columns);

        return !empty($results) ? $results->first()->total_count : 0;
    }
}
