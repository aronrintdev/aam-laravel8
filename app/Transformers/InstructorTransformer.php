<?php
namespace App\Transformers;

use App\Models\Account;
use App\Models\Instructor;
use League\Fractal;

/**
 * @OA\Schema(
 *   schema="instructor",
 *   required={""},
 *   @OA\Property(
 *     property="id",
 *     description="AccountID",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="type",
 *     description="account type",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="attributes",
 *     type="object",
 *       @OA\Property(
 *         property="first_name",
 *         description="First Name",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="last_name",
 *         description="Last Name",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="title",
 *         description="Title",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="profile_pic",
 *         description="Headshot Pic URL",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="bio",
 *         description="Optional Paragraph",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="philo",
 *         description="Optional Paragraph",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="accolades",
 *         description="Optional Paragraph",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="email",
 *         description="Email",
 *         type="string"
 *       )
 *   )
 * )
 */
class InstructorTransformer extends Fractal\TransformerAbstract
{
	public function transform(Instructor $acct)
	{
        $extraFields = [];
        if ($acct->Biography != '') {
            $extraFields['bio'] = $acct->Biography;
        }
        if ($acct->Philosophy != '') {
            $extraFields['philo'] = $acct->Philosophy;
        }
        if ($acct->Accomplishments != '') {
            $extraFields['accolades'] = $acct->Accomplishments;
        }

        //depending on how the instructor is loaded, we might hit
        //the account table and we might not.  InstructorID is a pointer
        //to the account table's AccountID, not an auto increment
        return [
            'id'         => (int) $acct->AccountID ? (int)$acct->AccountID : (int)$acct->InstructorID,
            'type'       => 'instructor',
            'attributes' => array_merge([
                'first_name'   =>  $acct->FirstName,
                'last_name'    =>  $acct->LastName,
                'title'        =>  $acct->Title,
                'profile_pic'  =>  $acct->HeadShot,
                'email'        =>  $acct->Email,
            ], $extraFields)
        ];
    }
}
