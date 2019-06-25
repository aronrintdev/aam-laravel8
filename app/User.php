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
    //this is only for eloquent access from
    //register
    public $connection = 'backendmysql';
    public $table      = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'FirstName', 'LastName', 'Address', 'City', 'State', 'Zip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'PasswordHash', 'Password',
    ];

    public function getJWTIdentifier() {
        return $this->Email;
    }

    public function getJWTCustomClaims() {
        return ['aid'=>$this->AccountID, 'fn'=>$this->FirstName, 'ln'=>$this->LastName, 'inst'=> ($this->IsInstructor > 0 ? 1:0), 'accid'=>$this->AcademyID];
    }

    /**
     * Determine if user was logged in with backend guard or not
     */
    public function isApiAgent() {
        if ($this->api_token != '') {
            return true;
        }
        return false;
    }
}
