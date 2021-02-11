<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *   schema="SwingExample",
 *   required={""},
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
class SwingExample extends SwingExamplePlus
{

    public $table = 'Swings';
    public $timestamps = false;
    public $connection = 'v1ga';
}
