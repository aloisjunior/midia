<?php

namespace ARsig\Policies;

use ARsig\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApiPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function facebookMetrics($user){
        return true;
    }
}
