<?php
namespace App\Transformers;

use App\Models\Account;
use App\Models\Instructor;
use App\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    protected $defaultIncludes = [
        'academies'
    ];

	public function transform(User $user)
	{
        //depending on how the instructor is loaded, we might hit
        //the account table and we might not.  InstructorID is a pointer
        //to the account table's AccountID, not an auto increment
        return [
            'id'         => (int) $user->AccountID ? (int)$user->AccountID : (int)$user->InstructorID,
            'type'       => 'user',
            'attributes' => [
                'first_name'    => $user->FirstName,
                'last_name'     => $user->LastName,
                'profile_pic'   => $user->HeadShot,
                'email'         => $user->Email,
                'account_type'  => $user->IsInstructor ? 'instructor' : 'user',
                'academy_ids'   => [],
                'academy_id'    => $user->AcademyID,
                'academy_owner' => $user->IsMaster,
            ]
        ];
    }

    public function includeAcademies(User $user) {
        return $this->collection([], new AcademyTransformer);
    }
}
