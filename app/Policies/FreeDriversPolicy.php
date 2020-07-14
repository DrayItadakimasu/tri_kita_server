<?php

namespace App\Policies;

use App\clients\FreeDrivers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FreeDriversPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any free drivers.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can view the free drivers.
     *
     * @param User $user
     * @param \App\FreeDrivers $freeDrivers
     * @return mixed
     */
    public function view(User $user, FreeDrivers $freeDrivers)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create free drivers.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->group_id == 3 || $user->group_id == 1;
    }

    /**
     * Determine whether the user can update the free drivers.
     *
     * @param User $user
     * @param \App\FreeDrivers $freeDrivers
     * @return mixed
     */
    public function update(User $user, FreeDrivers $freeDrivers)
    {
        return $user->id == $freeDrivers->user_id;
    }

    /**
     * Determine whether the user can delete the free drivers.
     *
     * @param User $user
     * @param \App\FreeDrivers $freeDrivers
     * @return mixed
     */
    public function delete(User $user, FreeDrivers $freeDrivers)
    {
        return
            $user->id == $freeDrivers->user_id or
            $user->id == 1;
    }

    /**
     * Determine whether the user can restore the free drivers.
     *
     * @param User $user
     * @param \App\FreeDrivers $freeDrivers
     * @return mixed
     */
    public function restore(User $user, FreeDrivers $freeDrivers)
    {
        return FALSE;
    }

    /**
     * Determine whether the user can permanently delete the free drivers.
     *
     * @param User $user
     * @param \App\FreeDrivers $freeDrivers
     * @return mixed
     */
    public function forceDelete(User $user, FreeDrivers $freeDrivers)
    {
        return FALSE;
    }
}
