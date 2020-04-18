<?php
namespace App\Transformers;

use App\Models\Academy;
use App\Models\Account;
use App\Models\Instructor;
use App\User;
use League\Fractal;

class AcademyTransformer extends Fractal\TransformerAbstract
{
	public function transform(Academy $academy)
	{
        //depending on how the instructor is loaded, we might hit
        //the account table and we might not.  InstructorID is a pointer
        //to the account table's AccountID, not an auto increment
        return [
            'id'         => (int) $academy->AccountID ? (int)$academy->AccountID : (int)$academy->InstructorID,
            'type'       => 'user',
            'attributes' => [
                'first_name'    => $academy->FirstName,
                'last_name'     => $academy->LastName,
                'profile_pic'   => $academy->HeadShot,
                'email'         => $academy->Email,
                'account_type'  => $academy->IsInstructor ? 'instructor' : 'user',
                'academy_ids'   => [],
                'academy_id'    => $academy->AcademyID,
                'academy_owner' => $academy->IsMaster,
            ]
        ];
    }
}
