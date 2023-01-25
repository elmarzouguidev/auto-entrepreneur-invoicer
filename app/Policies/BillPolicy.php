<?php

namespace App\Policies;

use App\Models\Finance\Bill;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BillPolicy
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
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bills.browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Bill $bill)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bills.read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bills.create')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de ajouter un Règlement .");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Bill $bill)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bills.edit')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de modifier un Règlement .");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Bill $bill)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('bills.delete')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de supprimer un Règlement .");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Bill $bill)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Bill $bill)
    {
        //
    }
}
