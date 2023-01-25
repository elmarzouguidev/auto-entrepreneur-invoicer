<?php

namespace App\Policies;

use App\Models\Finance\BCommand;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BCommandPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\BCommand  $bCommand
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, BCommand $bCommand)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bcommandes.read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bcommandes.create')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de crée un BC .");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\BCommand  $bCommand
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BCommand $bCommand)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bcommandes.edit')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de modifier ce  BC .");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\BCommand  $bCommand
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BCommand $bCommand)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bcommandes.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\BCommand  $bCommand
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, BCommand $bCommand)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bcommandes.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\BCommand  $bCommand
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, BCommand $bCommand)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bcommandes.delete');
    }
}
