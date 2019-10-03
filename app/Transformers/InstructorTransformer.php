<?php
namespace App\Transformers;

use App\Models\Account;
use App\Models\Instructor;
use League\Fractal;

/**
 * @OA\Schema(
 *   schema="Instructor",
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
 *     type="array",
 *     @OA\Items(
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
 *         property="email",
 *         description="Email",
 *         type="boolean"
 *       )
 *     )
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

	    return [
	        'id'         => (int) $acct->AccountID,
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
