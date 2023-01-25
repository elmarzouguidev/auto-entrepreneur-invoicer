<?php

namespace App\Policies;

use App\Models\Finance\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class InvoicePolicy
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
     * @param  \App\Models\Finance\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('invoices.create')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de crée une Facture .");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Invoice $invoice)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('invoices.edit')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de modifier cette Facture .");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Invoice $invoice)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin') || $user->hasPermissionTo('invoices.delete')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de supprimer cette Facture .");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Finance\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Invoice $invoice)
    {
        //
    }
}
