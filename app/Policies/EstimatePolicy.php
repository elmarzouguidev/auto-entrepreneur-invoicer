<?php

namespace App\Policies;

use App\Models\Finance\Estimate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EstimatePolicy
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
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Estimate  $estimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Estimate $estimate)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('estimates.read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('estimates.create')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de crée un DEVIS .");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Estimate  $estimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Estimate $estimate)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('estimates.edit')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de Modifier ce  DEVIS .");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Estimate  $estimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Estimate $estimate)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('estimates.delete')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de supprimer un DEVIS .");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Estimate  $estimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Estimate $estimate)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Estimate  $estimate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Estimate $estimate)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }
}
