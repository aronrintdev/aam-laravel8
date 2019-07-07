<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingRegistration extends Model
{
    //
    protected $table = 'pending_registration';
    protected $connection = 'backendmysql';
    protected $fillable = ['email', 'request', 'code'];
    protected $casts = ['request'=>'array'];
}
