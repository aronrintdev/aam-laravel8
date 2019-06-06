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
 *       )
 *     )
 *   )
 * )
 */
class StudentTransformer extends Fractal\TransformerAbstract
{
	public function transform(Account $acct)
	{
	    return [
	        'id'         => (int) $acct->AccountID,
	        'type'       => 'account',
            'attributes' => [
                'first_name'   =>  $acct->FirstName,
                'last_name'    =>  $acct->LastName,
                'email'        =>  $acct->Email,
            ]
	    ];
	}
}
