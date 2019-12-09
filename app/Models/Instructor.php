<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *   schema="LegacyInstructor",
 *   required={""},
 *   @OA\Property(
 *     property="SalesPerson",
 *     description="SalesPerson",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="NotableStudents",
 *     description="NotableStudents",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="ProCode",
 *     description="ProCode",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CourseAddress",
 *     description="CourseAddress",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FB_URL",
 *     description="FB_URL",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="HeadShot",
 *     description="HeadShot",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="TurnaroundDays",
 *     description="TurnaroundDays",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CourseWeb",
 *     description="CourseWeb",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="PlayingLevel",
 *     description="PlayingLevel",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="Fee",
 *     description="Fee",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="SampleLesson",
 *     description="SampleLesson",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Philosophy",
 *     description="Philosophy",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Founder",
 *     description="Founder",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="CourseProvince",
 *     description="CourseProvince",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="PrivateFlag",
 *     description="PrivateFlag",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="FacultyEmail",
 *     description="FacultyEmail",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="PersonalWebImage",
 *     description="PersonalWebImage",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="PGAMember",
 *     description="PGAMember",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="Available",
 *     description="Available",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="CourseName",
 *     description="CourseName",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CourseCity",
 *     description="CourseCity",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="DiscountRate",
 *     description="DiscountRate",
 *     type="number",
 *          format="float"
 *   ),
 *   @OA\Property(
 *     property="CoursePhone",
 *     description="CoursePhone",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Title",
 *     description="Title",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CourseAddress2",
 *     description="CourseAddress2",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="FreeLessons",
 *     description="FreeLessons",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="DiscountFee",
 *     description="DiscountFee",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="Biography",
 *     description="Biography",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="CourseZip",
 *     description="CourseZip",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="ActionShot",
 *     description="ActionShot",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SerialNo",
 *     description="SerialNo",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="AcademyID",
 *     description="AcademyID",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="PersonalWebLink",
 *     description="PersonalWebLink",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="InstructorID",
 *     description="InstructorID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CourseState",
 *     description="CourseState",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="V1ProVersion",
 *     description="V1ProVersion",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SetStudentCharge",
 *     description="SetStudentCharge",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="Accomplishments",
 *     description="Accomplishments",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="StartDate",
 *     description="StartDate",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SpecialtyCode",
 *     description="SpecialtyCode",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CourseCountry",
 *     description="CourseCountry",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="SportID",
 *     description="SportID",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="V1GAProCode",
 *     description="V1GAProCode",
 *     type="string"
 *   )
 * )
 */

class Instructor extends Model
{
#    use SoftDeletes;

    public $table = 'Instructors';
    
    public $timestamps = false;

    #const CREATED_AT = 'created_at';
    #const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'InstructorID';
    public $incrementing = false;

    public $fillable = [
        'InstructorID',
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'SalesPerson' => 'string',
        'NotableStudents' => 'string',
        'ProCode' => 'integer',
        'CourseAddress' => 'string',
        'FB_URL' => 'string',
        'HeadShot' => 'string',
        'CourseWeb' => 'string',
        'Fee' => 'integer',
        'SampleLesson' => 'string',
        'Philosophy' => 'string',
        'Founder' => 'boolean',
        'CourseProvince' => 'string',
        'PrivateFlag' => 'boolean',
        'FacultyEmail' => 'string',
        'PersonalWebImage' => 'string',
        'PGAMember' => 'boolean',
        'Available' => 'boolean',
        'CourseName' => 'string',
        'CourseCity' => 'string',
        'DiscountRate' => 'float',
        'CoursePhone' => 'string',
        'Title' => 'string',
        'CourseAddress2' => 'string',
        'FreeLessons' => 'integer',
        'DiscountFee' => 'integer',
        'Biography' => 'string',
        'CourseZip' => 'string',
        'ActionShot' => 'string',
        'SerialNo' => 'integer',
        'AcademyID' => 'string',
        'PersonalWebLink' => 'string',
        'InstructorID' => 'integer',
        'CourseState' => 'string',
        'V1ProVersion' => 'string',
        'SetStudentCharge' => 'boolean',
        'Accomplishments' => 'string',
        'StartDate' => 'string',
        'SpecialtyCode' => 'integer',
        'CourseCountry' => 'string',
        'SportID' => 'string',
        'V1GAProCode' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Fee' => 'required',
        'Founder' => 'required',
        'Available' => 'required',
        'FreeLessons' => 'required',
        'DiscountFee' => 'required',
        'InstructorID' => 'required',
        'SpecialtyCode' => 'required'
    ];

    
    public function academies() {
        return $this->belongsToMany('App\Models\Academy', 'AcademyInstructors', 'InstructorID', 'AcademyID')->wherePivot('IsEnabled', 1);
        //return $this->belongsToMany('App\Models\Academy')->user('App\Models\AcademyInstructors');
    }
}
