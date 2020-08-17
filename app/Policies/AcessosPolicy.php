<?php

namespace ARsig\Policies;

use ARsig\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AcessosPolicy
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

    public function verificaAcesso($ability): bool
    {
        dd($ability);
        return Auth::User()->hasAccess($ability);
    }
}
