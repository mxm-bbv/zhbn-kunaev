<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Articles');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Article $news): bool
    {
        return $user->checkPermissionTo('view Articles');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Articles');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $news): bool
    {
        return $user->checkPermissionTo('update Articles');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $news): bool
    {
        return $user->checkPermissionTo('delete Articles');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $news): bool
    {
        return $user->checkPermissionTo('restore Articles');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $news): bool
    {
        return $user->checkPermissionTo('force-delete Articles');
    }
}
