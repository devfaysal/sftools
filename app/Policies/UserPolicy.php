<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class UserPolicy
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

    public function viewAny()
    {
        return Gate::authorize('manage_users');
    }

    public function create()
    {
        return Gate::authorize('manage_users');
    }

    public function update()
    {
        return Gate::authorize('manage_users');
    }
}
