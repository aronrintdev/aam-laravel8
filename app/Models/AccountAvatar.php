<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountAvatar extends Model
{

    public $table         = 'AccountAvatars';
    public $timestamps    = false;
    public $dateFormat    = 'Y-m-d H:i:s.u';
    protected $primaryKey = 'AccountAvatarID';
    
    public $fillable = [
        'AccountID',
        'AvatarURL',
        'CreatedAt',
        'UpdatedAt',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'AccountAvatarID' => 'integer',
        'CreatedAt'       => 'datetime',
        'UpdatedAt'       => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'AccountID' => 'required',
        'AvatarURL' => 'required'
    ];
}
