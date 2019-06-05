<?php
namespace App\Transformers;

use App\Models\Account;
use League\Fractal;

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
