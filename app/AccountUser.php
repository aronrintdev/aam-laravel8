<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class AccountUser extends Authenticatable implements JWTSubject
{
    use Notifiable; //, HAsApiTokens;
    //this is only for eloquent access from
    //register
    public $connection = 'sqlsrv';
    public $table      = 'Accounts';
    public $primaryKey = 'AccountID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FirstName', 'LastName', 'AccountID', 'Email', 'AvatarURL', 'IsInstructor',
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
        return ['aid'=>(int)$this->AccountID, 'fn'=>$this->FirstName, 'ln'=>$this->LastName, 'inst'=> ($this->IsInstructor > 0 ? 1:0), 'accid'=>$this->AcademyID];
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

    public function getKey() {
        return $this->Email;
    }

    public function getEmailForPasswordReset()
    {
        return $this->Email;
    }

    /**
     * This DB access needs to hit the legacy
     * DB, but we have to shift the connection to
     * mysql for laravel registration.
     */
    public function hasInstructorConnection($instructorId)
    {
        $repo = new \App\Repositories\InstructorRepository(app());
        $student = $repo->students($instructorId, true, [$this->AccountID]);
        return ($student->count() > 0);
    }


    /**
     * MS Capitalization issue with email / Email
     */
    public function routeNotificationForMail($notification = null) {
        return $this->getEmailForPasswordReset();
    }

    public function routeNotificationFor($driver, $notification = null)
    {
        if (method_exists($this, $method = 'routeNotificationFor'.Str::studly($driver))) {
            return $this->{$method}($notification);
        }

        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                return $this->getEmailForPasswordReset();
            case 'nexmo':
                return $this->phone_number;
        }
    }

}
