<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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

    /**
     * Validate if user is admin
     */
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Undocumented function
     *
     * @param User $authUser
     * @param User $user
     * @return boolean
     */
    public function edit(User $authUser, User $user) : bool
    {
        return $authUser->id === $user->id;
    }

    /**
     * Undocumented function
     *
     * @param User $authUser
     * @param User $user
     * @return boolean
     */
    public function update(User $authUser, User $user) : bool
    {
        return $authUser->id === $user->id;
    }

    public function destroy(User $authUser, User $user) : bool
    {
        return $authUser->id === $user->id;
    }
}
