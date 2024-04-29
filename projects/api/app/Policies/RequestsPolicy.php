<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Requests;
use App\Models\User;

class RequestsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Requests');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Requests $requests): bool
    {
        return $user->checkPermissionTo('view Requests');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Requests');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Requests $requests): bool
    {
        return $user->checkPermissionTo('update Requests');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Requests $requests): bool
    {
        return $user->checkPermissionTo('delete Requests');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Requests $requests): bool
    {
        return $user->checkPermissionTo('restore Requests');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Requests $requests): bool
    {
        return $user->checkPermissionTo('force-delete Requests');
    }
}
