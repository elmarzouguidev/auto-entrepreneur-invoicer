<?php

namespace App\Policies;

use App\Models\Finance\Buy\BuyEstimate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyEstimatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Buy\BuyEstimate  $buyEstimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, BuyEstimate $buyEstimate)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Buy\BuyEstimate  $buyEstimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BuyEstimate $buyEstimate)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Buy\BuyEstimate  $buyEstimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BuyEstimate $buyEstimate)
    {
        return $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Buy\BuyEstimate  $buyEstimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, BuyEstimate $buyEstimate)
    {
        return $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Buy\BuyEstimate  $buyEstimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, BuyEstimate $buyEstimate)
    {
        return $user->hasRole('SuperAdmin');
    }
}