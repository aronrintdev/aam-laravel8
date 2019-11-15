<?php
namespace App\Transformers;

use App\Models\Account;
use League\Fractal;

/**
 * @OA\Schema(
 *   schema="Student",
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
 *       ),
 *       @OA\Property(
 *         property="pic_url",
 *         description="Profile Picture URL",
 *         type="string"
 *       )
 *       @OA\Property(
 *         property="joined_at",
 *         description="Date joined academy",
 *         type="datetime"
 *       )
 *     )
 *   )
 * )
 */
class StudentTransformer extends Fractal\TransformerAbstract
{
    /**
     * JoinedAt is the join date from the InstructorRepository query
     * PickedAt is the selected date from the InstructorRepository query
     */
	public function transform(Account $acct)
	{
	    return [
	        'id'         => (int) $acct->AccountID,
	        'type'       => 'account',
            'attributes' => [
                'first_name'   =>  $acct->FirstName,
                'last_name'    =>  $acct->LastName,
                'email'        =>  $acct->Email,
                'pic_url'      =>  $acct->AvatarURL,
                'joined_at'    =>  \Carbon\Carbon::parse(@$acct->PickedAt ?? @$acct->JoinedAt),
            ]
	    ];
	}
}
