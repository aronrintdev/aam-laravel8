<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorStudentsMulti extends Model
{
  use Traits\HasCompositePrimaryKey;

  protected $table      = 'InstructorStudentsMulti';
  protected $primaryKey = ['AccountID', 'InstructorID'];
  protected $fillable   = ['AccountID', 'InstructorID'];
  public $incrementing  = false;
  public $timestamps    = false;
}
