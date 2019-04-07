<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
    use Tymon\JWTAuth\Contracts\JWTSubject;



class User extends Authenticatable implements JWTSubject
{
    use Notifiable; //, HAsApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'AccountID','Email', 'Password', 'PasswordHash',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function getJWTIdentifier() {
		return $this->Email;
	}

	public function getJWTCustomClaims() {
		return ['aid'=>$this->AccountID];
	}
}
