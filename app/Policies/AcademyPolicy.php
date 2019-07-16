<?php

namespace App\Policies;

use App\User;
use App\Models\Academy;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the academy.
     *
     * @param  \App\User  $user
     * @param  \App\Academy  $academy
     * @return mixed
     */
    public function view( $user, Academy $academy)
    {
        return true;
    }

    /**
     * Determine whether the user can create academies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create( $user)
    {
        //
    }

    /**
     * Determine whether the user can update the academy.
     *
     * @param  \App\User  $user
     * @param  \App\Academy  $academy
     * @return mixed
     */
    public function update( $user, Academy $academy)
    {
        return ($user->IsInstructor && $user->AcademyID == trim($academy->AcademyID));
    }

    /**
     * Determine whether the user can delete the academy.
     *
     * @param  \App\User  $user
     * @param  \App\Academy  $academy
     * @return mixed
     */
    public function delete( $user, Academy $academy)
    {
        return ($user->IsInstructor && $user->AcademyID == trim($academy->AcademyID));
    }

    /**
     * Determine whether the user can restore the academy.
     *
     * @param  \App\User  $user
     * @param  \App\Academy  $academy
     * @return mixed
     */
    public function restore( $user, Academy $academy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the academy.
     *
     * @param  \App\User  $user
     * @param  \App\Academy  $academy
     * @return mixed
     */
    public function forceDelete( $user, Academy $academy)
    {
        //
    }
}
