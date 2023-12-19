<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BranchPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->hasRole(['admin', 'manager'])) return true;
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Branch $branch): bool
    {
        if($user->hasRole('admin')) return true;
        if($user->hasRole('manager') && in_array( $model->branch->id, $user->manager_branches)) return true;
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->hasRole('admin')) return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Branch $branch): bool
    {
        if($user->hasRole('admin')) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Branch $branch): bool
    {
        if($user->hasRole('admin')) return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Branch $branch): bool
    {
        if($user->hasRole('admin')) return true;
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Branch $branch): bool
    {
        if($user->hasRole('admin')) return true;
        return false;
    }
}
