<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *   schema="Swing",
 *   required={""},
 *   allOf={@OA\Schema(ref="http://jsonapi.org/schema#/components/schemas/resource")},
 *   @OA\Property(
 *     property="LessLogID",
 *     description="Smarter Lessons ID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="AcademyID",
 *     description="Custom Academy ID",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="BillError",
 *     description="BillError",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="InstructorID",
 *     description="InstructorID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="Description_U",
 *     description="Description_U",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="LastViewByInstructor",
 *     description="LastViewByInstructor",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="ProCharge",
 *     description="ProCharge",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="Rating",
 *     description="Rating",
 *     type="float",
 *          format="float"
 *   ),
 *   @OA\Property(
 *     property="SwingStatusID",
 *     description="SwingStatusID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="Description",
 *     description="Description",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Paid",
 *     description="Paid",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="SwingID",
 *     description="SwingID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="CCSwingID",
 *     description="CCSwingID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="VideoPath",
 *     description="VideoPath",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="VimeoID",
 *     description="VimeoID",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Billed",
 *     description="Billed",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="Deleted",
 *     description="Deleted",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="AccountID",
 *     description="AccountID",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="SocialQ",
 *     description="SocialQ",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="ProInvoice",
 *     description="ProInvoice",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="Charge",
 *     description="Charge",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="SportID",
 *     description="SportID",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="AnalysisPath",
 *     description="AnalysisPath",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="RatingIP",
 *     description="RatingIP",
 *     type="string"
 *   )
 * )
 */

class Swing extends Model
{
//    use SoftDeletes;

    public $table = 'Swings';
    
//    const CREATED_AT = 'created_at';
//    const UPDATED_AT = 'updated_at';


//    protected $dates = ['deleted_at'];

    protected $primaryKey = 'SwingID';

    public $fillable = [
        'LessLogID',
        'AcademyID',
        'BillError',
        'InstructorID',
        'Description_U',
        'LastViewByInstructor',
        'DateAnalyzed',
        'ProCharge',
        'Rating',
        'SwingStatusID',
        'DateRated',
        'DateUploaded',
        'Description',
        'Paid',
        'CCSwingID',
        'VideoPath',
        'VimeoID',
        'Billed',
        'Deleted',
        'AccountID',
        'SocialQ',
        'ProInvoice',
        'DateAccepted',
        'Charge',
        'SportID',
        'BillDate',
        'AnalysisPath',
        'LastViewed',
        'RatingIP'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'LessLogID' => 'integer',
        'AcademyID' => 'string',
        'BillError' => 'string',
        'InstructorID' => 'integer',
        'Description_U' => 'string',
        'LastViewByInstructor' => 'boolean',
        'ProCharge' => 'integer',
        'Rating' => 'float',
        'SwingStatusID' => 'integer',
        'Description' => 'string',
        'Paid' => 'boolean',
        'SwingID' => 'integer',
        'CCSwingID' => 'integer',
        'VideoPath' => 'string',
        'VimeoID' => 'string',
        'Billed' => 'boolean',
        'Deleted' => 'boolean',
        'AccountID' => 'integer',
        'SocialQ' => 'string',
        'ProInvoice' => 'string',
        'Charge' => 'integer',
        'SportID' => 'string',
        'AnalysisPath' => 'string',
        'RatingIP' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ProCharge' => 'required',
        'SwingID' => 'required',
        'VideoPath' => 'required',
        'AccountID' => 'required',
        'Charge' => 'required'
    ];

    
}
