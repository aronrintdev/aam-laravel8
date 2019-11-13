<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @OA\Schema(
 *   schema="AccountAvatar",
 *   required={"AccountID", "AvatarURL"},
 *   allOf={@OA\Schema(ref="/jsonapi.org-schema.json#/components/schemas/resource")},
 *   @OA\Property(
 *     property="id",
 *     description="id",
 *     type="integer",
 *          format="int32"
 *   ),
 *   @OA\Property(
 *     property="created_at",
 *     description="created_at",
 *     type="string",
 *          format="date-time"
 *   ),
 *   @OA\Property(
 *     property="updated_at",
 *     description="updated_at",
 *     type="string",
 *          format="date-time"
 *   )
 * )
 */

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
