<?php

namespace App\Policies;

use App\Models\Finance\Provider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProviderPolicy
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
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('providers.browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Provider  $provider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Provider $provider)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('providers.read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('providers.create')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de crée un Fournisseur .");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Provider  $provider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Provider $provider)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('providers.edit')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de modifier ce Fournisseur .");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Provider  $provider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Provider $provider)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('providers.delete')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de supprimer ce Fournisseur .");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Provider  $provider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Provider $provider)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Provider  $provider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Provider $provider)
    {
        //
    }
}
